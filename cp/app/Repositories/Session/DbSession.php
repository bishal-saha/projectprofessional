<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 5/9/18
 * Time: 5:49 PM
 */

namespace App\Repositories\Session;


use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class DbSession implements SessionRepository
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var Agent
     */
    private $agent;

    /**
     * DbSession constructor.
     * @param UserRepository $users
     * @param Agent $agent
     */
    public function __construct(UserRepository $users, Agent $agent)
    {
        $this->users = $users;
        $this->agent = $agent;
    }

    /**
     * Find session by id.
     * @param $sessionId
     * @return mixed
     */
    public function find($sessionId)
    {
        $session = DB::table('sessions')->where('id', $sessionId)->first();

        return $session ? $this->mapSessionAttributes($session) : null;
    }

    /**
     * Get all active sessions for specified user.
     *
     * @param $userId
     * @return mixed
     */
    public function getUserSessions($userId)
    {
        $validTimeStamp = Carbon::now()->subMinutes(config('session.lifetime'))->timestamp;

        return DB::table('sessions')
                    ->where('user_id', $userId)
                    ->where('last_activity', '>=', $validTimeStamp)
                    ->get()
                    ->map(function ($session) {
                        return $this->mapSessionAttributes($session);
                    });
    }

    private function mapSessionAttributes($session)
    {
        $this->agent->setUserAgent($session->user_agent);

        $session->last_activity = Carbon::createFromTimestamp($session->last_activity);
        $session->platform = $this->agent->platform();
        $session->browser = $this->agent->browser();
        $session->device = $this->agent->device();

        return $session;
    }

    /**
     * Invalidate specified session for provided user
     *
     * @param $sessionId
     * @return mixed
     */
    public function invalidateSession($sessionId)
    {
        $user = $this->users->findBySessionId($sessionId);

        DB::table('sessions')->where('id', $sessionId)->delete();

        $this->users->update($user->id, ['remember_token', null], null);
    }

    /**
     * Invalidate all sessions for user with given id.
     * @param $userId
     * @return mixed
     */
    public function invalidateAllSessionsForUser($userId)
    {
        DB::table('sessions')->where('user_id', $userId)->delete();

        $this->users->update($userId, ['remember_token' => null], null);
    }
}