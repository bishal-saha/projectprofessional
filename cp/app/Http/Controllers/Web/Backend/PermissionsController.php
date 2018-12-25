<?php

namespace App\Http\Controllers\Web\Backend;

use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Events\Role\PermissionsUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Permission;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\Request;

/**
 * Class PermissionsController
 *
 * @package Vanguard\Http\Controllers
 */
class PermissionsController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roles;
    /**
     * @var PermissionRepository
     */
    private $permissions;

    /**
     * PermissionsController constructor.
     * @param RoleRepository $roles
     * @param PermissionRepository $permissions
     */
    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->middleware('permission:permissions.manage');
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * Displays the page with all available permissions.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = $this->roles->all();

        //$perPage = 	Input::get('per_page', config('pagination.per_page'));
		//TODO: If we do pagination then the permission will sync only those permissions which are display at the page and remove all those which is not display on to the page. Find a solution.
        $perPage = 500;

        $permissions = $this->permissions->getAll(
			$perPage,
			Input::get('search'),
			Input::get('status')
		);

        return view('backend.permission.index', compact('roles', 'permissions'));
    }

    /**
     * Displays the form for creating new permission.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $edit = false;

        return view('backend.permission.add-edit', compact('edit'));
    }

    /**
     * Store permission to database.
     *
     * @param CreatePermissionRequest $request
     * @return mixed
     */
    public function store(CreatePermissionRequest $request)
    {
        $this->permissions->create($request->all());

        return redirect()->route('permission.index')
            ->withSuccess('Permission created successfully.');
    }

    /**
     * Displays the form for editing specific permission.
     *
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        $edit = true;

        return view('backend.permission.add-edit', compact('edit', 'permission'));
    }

    /**
     * Update specified permission.
     *
     * @param Permission $permission
     * @param UpdatePermissionRequest $request
     * @return mixed
     */
    public function update(Permission $permission, UpdatePermissionRequest $request)
    {
        $this->permissions->update($permission->uuid, $request->only('name', 'display_name', 'description'));

        return redirect()->route('permission.index')
            ->withSuccess('Permission updated successfully.');
    }

    /**
     * Destroy the permission if it is removable.
     *
     * @param Permission $permission
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        if (! $permission->removable) {
            throw new NotFoundHttpException;
        }

        $this->permissions->delete($permission->id);

        return redirect()->route('permission.index')
            ->withSuccess('Permission deleted successfully.');
    }

    /**
     * Update permissions for each role.
     *
     * @param Request $request
     * @return mixed
     */
    public function saveRolePermissions(Request $request)
    {
        $roles = $request->get('roles');

        $allRoles = $this->roles->lists('uuid');

        foreach ($allRoles as $roleUuid) {
            $permissions = array_get($roles, $roleUuid, []);
            $this->roles->updatePermissions($roleUuid, $permissions);
        }

        event(new PermissionsUpdated);

        return redirect()->route('permission.index')
            ->withSuccess('Permissions saved successfully.');
    }
}