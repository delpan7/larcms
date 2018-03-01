<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//登陆
Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\LoginController@login');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth.admin:admin']], function () {
    
    Route::get('logout', 'LoginController@logout');//登出
    Route::get('dash', 'DashboardController@index');//首页
    //前台菜单管理
    Route::resource('menu', 'MenuController');
    Route::post('menu/sort', 'MenuController@sort')->name('menu.sort');
    //文章页面
    Route::resource('article', 'ArticleController');
    Route::get('article/recycle', 'ArticleController@recycle')->name('article.recycle');
    Route::get('article/restore', 'ArticleController@restore')->name('article.restore');
    //评论
    Route::resource('comment', 'CommentController');
    Route::post('comment/approval', 'CommentController@approval')->name('comment.approval');
    //留言
    Route::get('message', 'MessageController@index')->name('message.index');
    //用户管理
    Route::resource('user', 'UserController');
    // Route::get('article/index', 'ArticleController@index');

    // Route::get('{controller}/{action}', function ($controller, $action) {
    //     $class = App::make('App\\Http\\Controllers\\Admin\\' . $controller . 'Controller');
    //     return $class->$action();
    // });

    // Route::post('{controller}/{action}', function ($controller, $action) {
    //     $class = App::make('App\\Http\\Controllers\\Admin\\' . $controller . 'Controller');
    //     return $class->$action();
    // });
    
});
