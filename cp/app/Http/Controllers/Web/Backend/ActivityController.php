<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Activity\EloquentActivity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * Class ActivityController
 * @package Vanguard\Http\Controllers
 */
class ActivityController extends Controller
{
    /**
     * @var EloquentActivity
     */
    private $activities;

    /**
     * ActivityController constructor.
     * @param ActivityRepository $activities
     */
    public function __construct(ActivityRepository $activities)
    {
        //$this->middleware('permission:usermanagement.user.activity');
        $this->activities = $activities;
    }

    /**
     * Displays the page with activities for all system users.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $adminView = true;

        $activities = $this->activities->paginateActivities(
			Input::get('per_page', config('pagination.per_page')),
			Input::get('search')
		);

        return view('backend.activity.index', compact('activities', 'adminView'));
    }

    /**
     * Displays the activity log page for specific user.
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userActivity(User $user, Request $request)
    {
        $perPage =  $request->get('per_page', config('pagination.per_page'));
        $adminView = true;

        $activities = $this->activities->paginateActivitiesForUser(
            $user->id, $perPage, $request->get('search')
        );

        return view('backend.activity.index', compact('activities', 'user', 'adminView'));
    }
}
