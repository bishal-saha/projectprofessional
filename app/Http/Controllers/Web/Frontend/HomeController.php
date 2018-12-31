<?php

namespace App\Http\Controllers\Web\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	/**
	 * Show the application home page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('frontend.home');
	}
}
