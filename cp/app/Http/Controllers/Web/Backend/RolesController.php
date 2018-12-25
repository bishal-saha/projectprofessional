<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Role;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class RolesController
 * @package App\Http\Controllers
 */
class RolesController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roles;

    /**
     * RolesController constructor.
     * @param RoleRepository $roles
     */
    public function __construct(RoleRepository $roles)
    {
        $this->middleware('permission:roles.manage');
        $this->roles = $roles;
    }

    /**
     * Display page with all available roles.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
		$roles = $this->roles->getAllWithUsersCount(
			Input::get('per_page', config('pagination.per_page')),
			Input::get('search'),
			Input::get('status')
		);
		return view('backend.role.index', compact('roles'));

	}
    public function create()
    {
        $edit = false;

        return view('backend.role.add-edit', compact('edit'));
    }

    /**
     * Store newly created role to database.
     *
     * @param CreateRoleRequest $request
     * @return mixed
     */
    public function store(CreateRoleRequest $request)
    {
        $this->roles->create($request->all());

        return redirect()->route('role.index')
            ->withSuccess('Role created successfully.');
    }

	/**
	 * View the details of the role.
	 *
	 * @param Role $role
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function view(Role $role)
	{
		return view('backend.role.view', compact('role'));
	}

    /**
     * Update specified role with provided data.
     *
     * @param Role $role
     * @param UpdateRoleRequest $request
     * @return mixed
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->roles->update($role->uuid, $request->all());

        return redirect()->route('role.edit', $role->uuid)
            ->withSuccess('Role updated successfully.');
    }

    /**
     * Display for for editing specified role.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $edit = true;

        return view('backend.role.add-edit', compact('edit', 'role'));
    }

    /**
     * Remove specified role from system.
     *
     * @param Role $role
     * @param UserRepository $userRepository
     * @return mixed
     */
    public function delete(UserRepository $userRepository)
    {
		$uuids = explode(',', Input::get('uuids'));

		if (in_array(Auth::user()->role->uuid, $uuids)) {
			return redirect()->route('role.index')
				->withErrors('You cannot delete your role.');
		}

		$userRole = $this->roles->findByName('User');

		foreach ($uuids as $uuid) {
			$role = Role::where('uuid', $uuid)->first();

			if (! $role->removable) {
				throw new NotFoundHttpException;
			}

			$userRepository->switchRolesForUsers($role->id, $userRole->id);
		}

        $this->roles->delete($uuids);

        Cache::flush();

        return redirect()->route('role.index')
            ->withSuccess('Role deleted successfully.');
    }

    public function export()
	{
		return true;
	}
}