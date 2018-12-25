<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 21/12/18
 * Time: 11:29 PM
 */

namespace App\Repositories\Page;


use App\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;

class EloquentPage implements PageRepository
{

	/**
	 * Paginate pages list.
	 *
	 * @param $perPage
	 * @param null $search
	 * @param null $status
	 * @return mixed
	 */
	public function paginate($perPage, $search = null, $status = null)
	{
		$query = Page::query();

		if ($status) {
			$query->where('is_active', $status);
		}

		if ($search) {
			$query->where(function ($q) use ($search) {
				$q->where('name', "like", "%{$search}%");
				$q->orWhere('slug', 'like', "%{$search}%");
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
	 * Find page by id.
	 *
	 * @param $id Page Id
	 * @return Page|null
	 */
	public function find($slug)
	{
		return Page::where('slug', $slug)->first();
	}

	/**
	 * Create new page.
	 *
	 * @param array $data
	 * @return Page
	 */
	public function create(array $data)
	{
		$page = Page::create($data);

		return $page;
	}

	/**
	 * Update specified page.
	 *
	 * @param $id Page Id
	 * @param array $data
	 * @return Page
	 */
	public function update($id, array $data)
	{
		$page = $this->find($id);

		$page->update($data);

		return $page;
	}

	/**
	 * Remove page from repository.
	 *
	 * @param array $uuids
	 * @return mixed
	 */
	public function delete(array $slugs)
	{
		foreach ($slugs as $slug) {
			$page = $this->find($slug);
			$page->delete();

			//event(new Deleted($page));
		}

		return;
	}

	/**
	 * Get the slug suggestion on specified name
	 *
	 * @param string$name
	 * @return mixed
	 */
	public function slugSuggestion($name)
	{
		return SlugService::createSlug(Page::class, 'slug', $name);
	}
}