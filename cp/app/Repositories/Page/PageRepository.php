<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 21/12/18
 * Time: 11:24 PM
 */

namespace App\Repositories\Page;

use App\Page;

interface PageRepository
{
	/**
	 * Paginate pages list.
	 *
	 * @param $perPage
	 * @param null $search
	 * @param null $status
	 * @return mixed
	 */
	public function paginate($perPage, $search = null, $status = null);

	/**
	 * Find page by id.
	 *
	 * @param $id Page Id
	 * @return Page|null
	 */
	public function find($id);

	/**
	 * Create new page.
	 *
	 * @param array $data
	 * @return Page
	 */
	public function create(array $data);

	/**
	 * Update specified page.
	 *
	 * @param $id Page Id
	 * @param array $data
	 * @return Page
	 */
	public function update($id, array $data);

	/**
	 * Remove page from repository.
	 *
	 * @param array $uuids
	 * @return mixed
	 */
	public function delete(array $uuids);

	/**
	 * Get the slug suggestion on specified name
	 *
	 * @param string$name
	 * @return mixed
	 */
	public function slugSuggestion($name);

}