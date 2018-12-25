<?php

namespace App\Repositories\Role;


use App\Events\Role\Deleted;
use App\Role;

class EloquentRole implements RoleRepository
{

    /**
     * Get all system roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Role::all();
    }

    /**
     * Lists all system roles into $key => $column value pairs.
     *
     * @param string $column
     * @param string $key
     * @return mixed
     */
    public function lists($column = 'name', $key = 'id')
    {
        return Role::pluck($column, $key);
    }

    /**
     * Get all system roles with number of users for each role.
     *
     * @return mixed
     */
    public function getAllWithUsersCount($perPage, $search = null, $status = null)
    {
        $query = Role::query();

		if ($status) {
			$query->where('status', $status);
		}

		$query->withCount('users');

		if ($search) {
			$query->where(function ($q) use ($search) {
				$q->where('name', "like", "%{$search}%");
				$q->orWhere('display_name', 'like', "%{$search}%");
				$q->orWhere('description', 'like', "%{$search}%");

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
     * Find system role by uuid.
     *
     * @param $uuid Role Id
     * @return Role|null
     */
    public function find($uuid)
    {
        return Role::where('uuid', $uuid)->first();
    }

    /**
     * Find role by name:
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        return Role::where('name', $name)->first();
    }

    /**
     * Create new system role.
     *
     * @param array $data
     * @return Role
     */
    public function create(array $data)
    {
        $role = Role::create($data);

        return $role;
    }

    /**
     * Update specified role.
     *
     * @param $id Role Id
     * @param array $data
     * @return Role
     */
    public function update($id, array $data)
    {
        $role = $this->find($id);

        $role->update($data);

        return $role;
    }

    /**
     * Remove role from repository.
     *
     * @param $uuid Role UUID
     * @return mixed
     */
    public function delete(array $uuids)
    {
		foreach ($uuids as $uuid) {
			$role = $this->find($uuid);
			$role->delete();
			event(new Deleted($role));
		}

		return;
    }

    /**
     * Update the permissions for given role.
     *
     * @param $roleId
     * @param array $permissions
     * @return mixed
     */
    public function updatePermissions($roleUuid, $permissions)
    {
        $role = $this->find($roleUuid);

        $role->syncPermissions($permissions);
    }
}