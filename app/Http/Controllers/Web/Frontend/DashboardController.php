<?php

namespace App\Http\Controllers\Web\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user =  Auth::user();

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return $this->userDashboard();
    }

    public function userDashboard()
    {
        return view('frontend.dashboard.default');
    }
}
