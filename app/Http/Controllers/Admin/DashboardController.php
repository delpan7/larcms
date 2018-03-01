<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController as Controller;
use Illuminate\Http\Request;
use Route;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Route::current(), Route::currentRouteName(), Route::currentRouteAction());
        $this->attr['title'] = 'Dashboard';
        // dd('后台首页，当前用户名：'.auth('admin')->user()->name);
        return view('admin.dashboard.index',  compact('title'));
    }
}
