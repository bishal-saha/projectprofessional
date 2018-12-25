<?php

namespace App\Http\Controllers\Web\Backend;

use App\Events\User\ChangedAvatar;
use App\Events\User\UpdatedProfileDetails;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileDetailsRequest;
use App\Http\Requests\User\UpdateProfileLoginDetailsRequest;
use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Country\CountryRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Session\SessionRepository;
use App\Repositories\User\UserRepository;
use App\Services\Upload\UserAvatarManager;
use App\Support\Enum\UserStatus;
use App\User;
use Auth;
use Illuminate\Http\Request;

/**
 * Class ProfileController
 * @package Vanguard\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * @var User
     */
    protected $theUser;
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);

        $this->users = $users;

        $this->middleware(function ($request, $next) {
            $this->theUser = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display user's profile page.
     *
     * @param RoleRepository $rolesRepo
     * @param CountryRepository $countryRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(RoleRepository $rolesRepo, CountryRepository $countryRepository)
    {
        $user = $this->theUser;
        $edit = true;
        $roles = $rolesRepo->lists();
        $countries = [0 => 'Select a Country'] + $countryRepository->lists()->toArray();
        $statuses = UserStatus::lists();

        return view(
            'backend.user.profile',
            compact('user', 'edit', 'roles', 'countries', 'statuses')
        );
    }

    /**
     * Update profile details.
     *
     * @param UpdateProfileDetailsRequest $request
     * @return mixed
     */
    public function updateDetails(UpdateProfileDetailsRequest $request)
    {
		$userData = $request->only(
			'first_name', 'last_name', 'username', 'password', 'email', 'phone'
		);

		$profileData = $request->only('birthday', 'address', 'country_id');

        $this->users->update($this->theUser->id, $userData, $profileData);

        event(new UpdatedProfileDetails);

        return redirect()->back()
            ->withSuccess('Profile updated successfully.');
    }

    /**
     * Upload and update user's avatar.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatar(Request $request, UserAvatarManager $avatarManager)
    {
        $this->validate($request, [
            'avatar' => 'image'
        ]);

        $name = $avatarManager->uploadAndCropAvatar(
            $this->theUser,
            $request->file('avatar'),
            $request->get('points')
        );

        if ($name) {
            return $this->handleAvatarUpdate($name);
        }

        return redirect()->route('my.profile')
            ->withErrors('Avatar image cannot be updated. Please try again.');
    }

    /**
     * Update avatar for currently logged in user
     * and fire appropriate event.
     *
     * @param $avatar
     * @return mixed
     */
    private function handleAvatarUpdate($avatar)
    {
        $this->users->update($this->theUser->id, null, ['avatar' => $avatar]);

        event(new ChangedAvatar);

        return redirect()->route('my.profile')
            ->withSuccess('Avatar changed successfully.');
    }

    /**
     * Update user's avatar from external location/url.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatarExternal(Request $request, UserAvatarManager $avatarManager)
    {
        $avatarManager->deleteAvatarIfUploaded($this->theUser);

        return $this->handleAvatarUpdate($request->get('url'));
    }

    /**
     * Update user's login details.
     *
     * @param UpdateProfileLoginDetailsRequest $request
     * @return mixed
     */
    public function updateLoginDetails(UpdateProfileLoginDetailsRequest $request)
    {
        $userData = $request->except('role', 'status');

        // If password is not provided, then we will
        // just remove it from $data array and do not change it
        if (trim($userData['password']) == '') {
            unset($userData['password']);

            unset($userData['password_confirmation']);
        }

        $this->users->update($this->theUser->id, $userData, null);

        return redirect()->route('my.profile')
            ->withSuccess('Login details updated successfully.');
    }

    /**
     * Display user activity log.
     *
     * @param ActivityRepository $activitiesRepo
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activity(ActivityRepository $activitiesRepo, Request $request)
    {
        $user = $this->theUser;
		$adminView = false;
		$perPage =  $request->get('per_page', config('pagination.per_page'));

        $activities = $activitiesRepo->paginateActivitiesForUser(
            $user->id,
            $perPage,
            $request->get('search')
        );

        return view('backend.activity.index', compact('activities', 'user', 'adminView'));
    }


    /**
     * Display active sessions for current user.
     *
     * @param SessionRepository $sessionRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sessions(SessionRepository $sessionRepository)
    {
        $profile = true;
        $user = $this->theUser;
        $sessions = $sessionRepository->getUserSessions($user->id);

        return view('backend.user.sessions', compact('sessions', 'user', 'profile'));
    }

    /**
     * Invalidate user's session.
     *
     * @param $session \stdClass Session object.
     * @param SessionRepository $sessionRepository
     * @return mixed
     */
    public function invalidateSession($session, SessionRepository $sessionRepository)
    {
        $sessionRepository->invalidateSession($session->id);

        return redirect()->route('my.sessions')
            ->withSuccess('Session invalidated successfully.');
    }
}
