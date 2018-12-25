<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
	public function showHome()
	{
		return view('welcome');
	}
    public function showContent(Page $page)
	{
		echo "<pre>";
		print_r($page);
		echo "<pre>";
	}
}
