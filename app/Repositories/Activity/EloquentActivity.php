<?php

namespace App\Repositories\Activity;


use App\Services\Logging\UserActivity\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\Paginator;

class EloquentActivity implements ActivityRepository
{

    /**
     * Log user activity.
     *
     * @param $data array Array with following fields:
     *      description (string) - Description of user activity.
     *      user_id (int) - User unique identifier.
     *      ip_address (string) - Ip address from which user is accessing the website.
     *      user_agent (string) - User's browser info.
     * @return mixed
     */
    public function log($data)
    {
        return Activity::create($data);
    }

    /**
     * Paginate activities for user.
     *
     * @param $userId
     * @param int $perPage
     * @param null $search
     * @return mixed
     */
    public function paginateActivitiesForUser($userId, $perPage = 20, $search = null)
    {
        $query = Activity::where('user_id', $userId);

        return $this->paginateAndFilterResults($perPage, $search, $query);
    }

    /**
     * Get specified number of latest user activity logs.
     *
     * @param $userId
     * @param int $activitiesCount
     * @return mixed
     */
    public function getLatestActivitiesForUser($userId, $activitiesCount = 10)
    {
        return Activity::where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit($activitiesCount)
            ->get();
    }

    /**
     * Paginate all activity records.
     *
     * @param int $perPage
     * @param null $search
     * @return Paginator
     */
    public function paginateActivities($perPage = 10, $search = null)
    {
        $query = Activity::with('user');

        return $this->paginateAndFilterResults($perPage, $search, $query);
    }

    /**
     * Get count of user activities per day for given period of time.
     *
     * @param $userId
     * @param $from
     * @param $to
     * @return mixed
     */
    public function userActivityForPeriod($userId, Carbon $from, Carbon $to)
    {
        $result = Activity::select([
            DB::raw('DATE(created_at) as day'),
            DB::raw('count(id) as count')
        ])->where('user_id', $userId)
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('day')
            ->orderBy('day', 'ASC')
            ->pluck('count', 'day');

        while (! $from->isSameDay($to)) {
            if (! $result->has($from->toDateString())) {
                $result->put($from->toDateString(), 0);
            }
            $from->addDay();
        }

        return $result->sortBy(function($value, $key) {
            return strtotime($key);
        });
    }

    /**
     * @param $perPage
     * @param $search
     * @param $query
     * @return mixed
     */
    private function paginateAndFilterResults($perPage, $search, $query)
    {
		if ($search) {
            $query->where('description', 'LIKE', "%$search%");
        }

        $result = $query->orderBy('created_at', 'DESC')->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }
}