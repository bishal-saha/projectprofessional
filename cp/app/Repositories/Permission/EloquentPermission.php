<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 5/9/18
 * Time: 5:20 PM
 */

namespace App\Repositories\Permission;


use App\Permission;
use Illuminate\Support\Facades\Cache;

class EloquentPermission implements PermissionRepository
{

    /**
     * Get all system permissions.
     *
     * @return mixed
     */
    public function all()
    {
        return Permission::all();
    }

	public function getAll($perPage, $search = null, $status = null)
	{
		$query = Permission::query();

		if ($status) {
			$query->where('status', $status);
		}

		if ($search) {
			$query->where(function ($q) use ($search) {
				$q->where('name', "like", "%{$search}%");
				$q->orWhere('display_name', 'like', "%{$search}%");
				$q->orWhere('description', 'like', "%{$search}%");

			});
		}

		$result = $query->orderBy('name', 'desc')
			->paginate($perPage);

		if ($search) {
			$result->appends(['search' => $search]);
		}

		return $result;
	}

    /**
     * Finds the permission by given id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Permission::find($id);
    }

	/**
	 * Finds the permission by given uuid.
	 *
	 * @param $id
	 * @return mixed
	 */
	public function findByUuid($uuid)
	{
		return Permission::where('uuid', $uuid)->first();
	}

    /**
     * Creates new permission from provided data.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $permission = Permission::create($data);
    }

    /**
     * Updates specified permission.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($uuid, array $data)
    {
        $permission = $this->findByUuid($uuid);

        $permission->update($data);

        Cache::flush();
    }

    /**
     * Remove specified permission from repository.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $permission = $this->find($id);

        $status = $permission->delete();

        Cache::flush();

        return $status;
    }
}