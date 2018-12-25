<?php

namespace App\Http\Controllers\Web\Backend;

use App\Events\User\Banned;
use App\Events\User\Deleted;
use App\Events\User\UpdatedByAdmin;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateDetailsRequest;
use App\Http\Requests\User\UpdateLoginDetailsRequest;
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
use Illuminate\Support\Facades\Input;

/**
 * Class UsersController
 * @package Vanguard\Http\Controllers
 */
class UsersController extends Controller
{
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
        $this->middleware('permission:users.manage');

        $this->users = $users;
    }

    /**
     * Display paginated list of all users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->users->paginate(
            Input::get('per_page', config('pagination.per_page')),
            Input::get('search'),
            Input::get('status')
        );

        $statuses = ['' => 'All'] + UserStatus::lists();

        return view('backend.user.list', compact('users', 'statuses'));
    }

    /**
     * Displays user profile page.
     *
     * @param User $user
     * @param ActivityRepository $activities
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(User $user, ActivityRepository $activities)
    {
    	$userActivities = $activities->getLatestActivitiesForUser($user->id, 10);

        return view('backend.user.view', compact('user', 'userActivities'));
    }

    /**
     * Displays form for creating a new user.
     *
     * @param CountryRepository $countryRepository
     * @param RoleRepository $roleRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CountryRepository $countryRepository, RoleRepository $roleRepository)
    {
        $countries = $this->parseCountries($countryRepository);
        $roles = $roleRepository->lists();
        $statuses = UserStatus::lists();

        return view('backend.user.add', compact('countries', 'roles', 'statuses'));
    }

    /**
     * Parse countries into an array that also has a blank
     * item as first element, which will allow users to
     * leave the country field unpopulated.
     * @param CountryRepository $countryRepository
     * @return array
     */
    private function parseCountries(CountryRepository $countryRepository)
    {
        return [0 => 'Select a Country'] + $countryRepository->lists()->toArray();
    }

    /**
     * Stores new user into the database.
     *
     * @param CreateUserRequest $request
     * @return mixed
     */
    public function store(CreateUserRequest $request)
    {
        // When user is created by administrator, we will set his
        // status to Active by default.

		$userData = $request->only(
			'first_name', 'last_name', 'username', 'password', 'email', 'phone', 'status'
		);

		$profileData = $request->only('birthday', 'address', 'country_id');

        $user = $this->users->create($userData, $profileData);

        return redirect()->route('user.list')
            ->withSuccess('User created successfully.');
    }

    /**
     * Displays edit user form.
     *
     * @param User $user
     * @param CountryRepository $countryRepository
     * @param RoleRepository $roleRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user, CountryRepository $countryRepository, RoleRepository $roleRepository)
    {
        $edit = true;
        $countries = $this->parseCountries($countryRepository);
        $roles = $roleRepository->lists();
        $statuses = UserStatus::lists();

        return view(
            'backend.user.edit',
            compact('edit', 'user', 'countries', 'roles', 'statuses')
        );
    }

    /**
     * Updates user details.
     *
     * @param User $user
     * @param UpdateDetailsRequest $request
     * @return mixed
     */
    public function updateDetails(User $user, UpdateDetailsRequest $request)
    {
        $userData = $request->only(
        	'first_name', 'last_name', 'username', 'password', 'email', 'phone', 'status'
		);

		$profileData = $request->only('birthday', 'address', 'country_id');

        if (! array_get($profileData, 'country_id')) {
            $profileData['country_id'] = null;
        }

        $this->users->update($user->id, $userData, $profileData);
        $this->users->setRole($user->id, $request->role_id);

        event(new UpdatedByAdmin($user));

        // If user status was updated to "Banned",
        // fire the appropriate event.
        if ($this->userIsBanned($user, $request)) {
            event(new Banned($user));
        }

        return redirect()->back()
            ->withSuccess('User updated successfully.');
    }

    /**
     * Check if user is banned during last update.
     *
     * @param User $user
     * @param Request $request
     * @return bool
     */
    private function userIsBanned(User $user, Request $request)
    {
        return $user->status != $request->status && $request->status == UserStatus::BANNED;
    }

    /**
     * Update user's avatar from uploaded image.
     *
     * @param User $user
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatar(User $user, UserAvatarManager $avatarManager, Request $request)
    {
        $this->validate($request, ['avatar' => 'image']);

        $name = $avatarManager->uploadAndCropAvatar(
            $user,
            $request->file('avatar'),
            $request->get('points')
        );

        if ($name) {

            $this->users->update($user->id, null, ['avatar' => $name]);

            event(new UpdatedByAdmin($user));

            return redirect()->route('user.edit', $user->uuid)
                ->withSuccess('Avatar changed successfully.');
        }

        return redirect()->route('user.edit', $user->uuid)
            ->withErrors('Avatar image cannot be updated. Please try again.');
    }

    /**
     * Update user's avatar from some external source (Gravatar, Facebook, Twitter...)
     *
     * @param User $user
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatarExternal(User $user, Request $request, UserAvatarManager $avatarManager)
    {
        $avatarManager->deleteAvatarIfUploaded($user);

        $this->users->update($user->id, null, ['avatar' => $request->get('url')]);

        event(new UpdatedByAdmin($user));

        return redirect()->route('user.edit', $user->uuid)
            ->withSuccess('Avatar changed successfully.');
    }

    /**
     * Update user's login details.
     *
     * @param User $user
     * @param UpdateLoginDetailsRequest $request
     * @return mixed
     */
    public function updateLoginDetails(User $user, UpdateLoginDetailsRequest $request)
    {
        $data = $request->all();

        if (trim($data['password']) == '') {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $this->users->update($user->id, $data, null);

        event(new UpdatedByAdmin($user));

        return redirect()->route('user.edit', $user->uuid)
            ->withSuccess('Login details updated successfully.');
    }

    /**
     * Removes the user from database.
     *
     * @param User $user
     * @return $this
     */
    public function delete(Request $request)
    {
		$uuids = explode(',', $request->uuids);

        if (in_array(Auth::user()->uuid, $uuids)) {
            return redirect()->route('user.list')
                ->withErrors('You cannot delete yourself.');
        }

        $this->users->delete($uuids);

        return redirect()->route('user.list')
            ->withSuccess('User deleted successfully.');
    }


    /**
     * Displays the list with all active sessions for selected user.
     *
     * @param User $user
     * @param SessionRepository $sessionRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sessions(User $user, SessionRepository $sessionRepository)
    {
        $adminView = true;
        $sessions = $sessionRepository->getUserSessions($user->id);

        return view('backend.user.sessions', compact('sessions', 'user', 'adminView'));
    }

    /**
     * Invalidate specified session for selected user.
     *
     * @param User $user
     * @param $session
     * @param SessionRepository $sessionRepository
     * @return mixed
     */
    public function invalidateSession(User $user, $session, SessionRepository $sessionRepository)
    {
        $sessionRepository->invalidateSession($session->id);

        return redirect()->route('user.sessions', $user->uuid)
            ->withSuccess('Session invalidated successfully.');
    }

	public function export(UserRepository $users, Request $request)
	{
		return new UsersExport($users, $request);
	}
}
