<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class AdminController extends Controller {

    /**
     * 页面返回值
     *
     * @var array
     */
    protected $attr = [];

    /**
     * Initializer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->attr['menu_list'] = Menu::getList();
        // $this->middleware('auth.admin:admin');
    }

}