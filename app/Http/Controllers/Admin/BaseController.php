<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Route;

class BaseController extends Controller
{
    /**
     * 页面返回值
     *
     * @var array
     */
    protected $attr = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth.admin:admin');
    }
}
