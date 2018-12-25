<?php

namespace App\Repositories\User;


use App\User;
use Carbon\Carbon;

interface UserRepository
{
    /**
     * Paginate registered users.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);

    /**
     * Find user by its id.
     *
     * @param $id
     * @return null|User
     */
    public function find($id);

    /**
     * Find user by email.
     *
     * @param $email
     * @return null|User
     */
    public function findByEmail($email);


    /**
     * Find user by specified session id.
     *
     * @param $sessionId
     * @return mixed
     */
    public function findBySessionId($sessionId);

    /**
     * Create new user.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update user specified by it's id.
     *
     * @param $id
     * @param array $userData update the users table
	 * @param array $profileData update the user_profile table
     * @return User
     */
    public function update($id, array $userData, array $profileData);

    /**
     * Delete user with provided id.
     *
     * @param array $id
     * @return mixed
     */
    public function delete(array $id);


    /**
     * Number of users in database.
     *
     * @return mixed
     */
    public function count();

    /**
     * Number of users registered during current month.
     *
     * @return mixed
     */
    public function newUsersCount();

    /**
     * Number of users with provided status.
     *
     * @param $status
     * @return mixed
     */
    public function countByStatus($status);

    /**
     * Count of registered users for every month within the
     * provided date range.
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function countOfNewUsersPerMonth(Carbon $from, Carbon $to);

    /**
     * Get latest {$count} users from database.
     *
     * @param $count
     * @return mixed
     */
    public function latest($count = 20);

    /**
     * Set specified role to specified user.
     *
     * @param $userId
     * @param $roleId
     * @return mixed
     */
    public function setRole($userId, $roleId);

    /**
     * Change role for all users who has role $fromRoleId to $toRoleId.
     *
     * @param $fromRoleId Id of current role.
     * @param $toRoleId Id of new role.
     * @return mixed
     */
    public function switchRolesForUsers($fromRoleId, $toRoleId);

    /**
     * Get all users with provided role.
     *
     * @param $roleName
     * @return mixed
     */
    public function getUsersWithRole($roleName);



    /**
     * Find user by confirmation token.
     *
     * @param $token
     * @return mixed
     */
    public function findByConfirmationToken($token);

	/**
	 * Prepare query for export.
	 *
	 * @param null $search
	 * @param null $status
	 * @return mixed
	 */
	public function export($uuid = null, $status = null);
}