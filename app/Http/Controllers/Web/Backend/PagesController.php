<?php

namespace App\Http\Controllers\Web\Backend;

use App\Events\User\UpdatedByAdmin;
use App\Http\Requests\Page\CreatePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Http\Requests\Request;
use App\Page;
use App\Repositories\Page\PageRepository;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
{
	/**
	 * @var PageRepository
	 */
    private $pages;

    public function __construct(PageRepository $pages)
	{
		$this->middleware('permission:pages.manage');

		$this->pages = $pages;
	}

	/**
	 * Display paginated list of all users.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$pages = $this->pages->paginate(
			Input::get('per_page', config('pagination.per_page')),
			Input::get('search'),
			Input::get('status')
		);

		return view('backend.pages.list', compact('pages'));
	}

	/**
	 * Displays page details.
	 *
	 * @param Page $page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function view(Page $page)
	{
		return view('backend.pages.view', compact('page'));
	}

	/**
	 * Displays page edit form.
	 *
	 * @param Page $page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Page $page)
	{
		$edit = true;

		return view( 'backend.pages.add-edit', 	compact('edit', 'page'));
	}

	/**
	 * Show the form to create the page content
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		$edit = false;

		return view('backend.pages.add-edit', compact('edit'));
	}

	/**
	 * Store newly created page to database.
	 *
	 * @param CreatePageRequest $request
	 * @return mixed
	 */
	public function store(CreatePageRequest $request)
	{
		$request->request->add(['author_id' => Auth::id()]);

		$this->pages->create($request->all());

		return redirect()->route('page.index')
			->withSuccess('Page created successfully.');
	}

	/**
	 * Updates page details.
	 *
	 * @param Page $page
	 * @param UpdatePageRequest $request
	 * @return mixed
	 */
	public function update(Page $page, UpdatePageRequest $request)
	{
		$data = $request->only(
			'name', 'slug', 'excerpt', 'content', 'image', 'meta_title', 'meta_keywords', 'meta_description', 'is_active'
		);

		$profileData['author_id'] = Auth::id();

		$page = $this->pages->update($page->slug, $data);

		//event(new UpdatedByAdmin($page));

		return redirect()->route('page.edit', $page->slug)
			->withSuccess('Page updated successfully.');
	}

	/**
	 * Remove specified page from system.
	 *
	 * @param Page $page
	 * @param PageRepository $pageRepository
	 * @return mixed
	 */
	public function delete(PageRepository $pageRepository)
	{
		$slugs = explode(',', Input::get('slugs'));

		$this->pages->delete($slugs);

		return redirect()->route('page.index')
			->withSuccess('Page deleted successfully.');
	}

	public function export()
	{
		return true;
	}

	public function getSlugSuggestion()
	{
		echo $this->pages->slugSuggestion(Input::get('name'));
	}
}
