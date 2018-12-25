<?php

namespace App\Repositories\User;

use App\Events\User\Deleted;
use App\Repositories\Role\RoleRepository;
use App\Role;
use App\Services\Auth\Social\ManagesSocialAvatarSize;
use App\Services\Upload\UserAvatarManager;
use App\Support\Helpers\Helper;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentUser implements UserRepository
{
    use ManagesSocialAvatarSize;

    /**
     * @var UserAvatarManager
     */
    private $avatarManager;

    /**
     * @var RoleRepository
     */
    private $roles;

    public function __construct(UserAvatarManager $avatarManager, RoleRepository $roles)
    {
        $this->avatarManager = $avatarManager;
        $this->roles = $roles;
    }

    /**
     * Paginate registered users.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = User::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', "like", "%{$search}%");
                $q->orWhere('email', 'like', "%{$search}%");
                $q->orWhere('first_name', 'like', "%{$search}%");
                $q->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $result = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * Find user by its id.
     *
     * @param $id
     * @return null|User
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * Find user by email.
     *
     * @param $email
     * @return null|User
     */
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }


    /**
     * Find user by specified session id.
     *
     * @param $sessionId
     * @return mixed
     */
    public function findBySessionId($sessionId)
    {
        return User::leftJoin('sessions', 'users.id', '=', 'sessions.user_id')
            ->select('users.*')
            ->where('sessions.id', $sessionId)
            ->first();
    }

    /**
     * Create new user.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $userData = null, array $profileData = null)
    {
        $user =  User::create($userData);
        $user->profile()->create($profileData);

        return $user;
    }

    /**
     * Update user specified by it's id.
     *
     * @param $id
     * @param array $userData  update the users table
	 * @param array $profileData update the user_profile table
     * @return User
     */
    public function update($id, array $userData = null, array $profileData = null)
    {
        if (isset($profileData['country_id']) && $profileData['country_id'] == 0) {
            $profileData['country_id'] = null;
        }

        $user = $this->find($id);

		if (!is_null($userData)) {
			$user->update($userData);
		}

        // If you want to update only user table, then skip the user_profile table
        if (!is_null($profileData)) {
			$user->profile()->update($profileData);
		}

        return $user;
    }

    /**
     * Delete user with provided id.
     *
     * @param array $uuids
     * @return mixed
     */
    public function delete(array $uuids)
    {
		foreach ($uuids as $uuid) {
			$user = User::where('uuid', $uuid)->first();
			$this->avatarManager->deleteAvatarIfUploaded($user);
			$user->delete();
			event(new Deleted($user));
    	}
        return;
    }



    /**
     * Number of users in database.
     *
     * @return mixed
     */
    public function count()
    {
        return User::count();
    }

    /**
     * Number of users registered during current month.
     *
     * @return mixed
     */
    public function newUsersCount()
    {
        return User::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()])
            ->count();
    }

    /**
     * Number of users with provided status.
     *
     * @param $status
     * @return mixed
     */
    public function countByStatus($status)
    {
        return User::where('status', $status)->count();
    }

    /**
     * Count of registered users for every month within the
     * provided date range.
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function countOfNewUsersPerMonth(Carbon $from, Carbon $to)
    {
        $result = User::whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get(['created_at'])
            ->groupBy(function ($user) {
                return $user->created_at->format("Y_n");
            });

        $counts = [];

        while ($from->lt($to)) {
            $key = $from->format("Y_n");

            $counts[$this->parseDate($key)] = count($result->get($key, []));

            $from->addMonth();
        }

        return $counts;
    }

    /**
     * Parse date from "Y_m" format to "{Month Name} {Year}" format.
     * @param $yearMonth
     * @return string
     */
    private function parseDate($yearMonth)
    {
        list($year, $month) = explode("_", $yearMonth);

        $month = Helper::printMonthName($month);

        return "{$month} {$year}";
    }

    /**
     * Get latest {$count} users from database.
     *
     * @param $count
     * @return mixed
     */
    public function latest($count = 20)
    {
        return User::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * Set specified role to specified user.
     *
     * @param $userId
     * @param $roleId
     * @return mixed
     */
    public function setRole($userId, $roleId)
    {
        return $this->find($userId)->setRole($roleId);
    }

    /**
     * Change role for all users who has role $fromRoleId to $toRoleId.
     *
     * @param $fromRoleId Id of current role.
     * @param $toRoleId Id of new role.
     * @return mixed
     */
    public function switchRolesForUsers($fromRoleId, $toRoleId)
    {
        return User::where('role_id', $fromRoleId)
            ->update(['role_id' => $toRoleId]);
    }

    /**
     * Get all users with provided role.
     *
     * @param $roleName
     * @return mixed
     */
    public function getUsersWithRole($roleName)
    {
        return Role::where('name', $roleName)
            ->first()
            ->users;
    }



    /**
     * Find user by confirmation token.
     *
     * @param $token
     * @return mixed
     */
    public function findByConfirmationToken($token)
    {
        return User::where('confirmation_token', $token)->first();
    }

	/**
	 * Prepare query for export.
	 *
	 * @param null $search
	 * @param null $status
	 * @return mixed
	 */
	public function export($uuid = null, $status = null)
	{
		$query = User::query();

		if ($uuid !== null) {
			$uuids = explode(',', $uuid);

			$query->whereIn('uuid', $uuids);
		}

		if ($status !== null) {
			$query->where('status', $status);
		}

		$result = $query->orderBy('first_name', 'ASC');

		return $result;
	}
}