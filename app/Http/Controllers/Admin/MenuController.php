<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Menu as MenuRequest;
use App\Http\Controllers\AdminController as Controller;
use App\Models\Menu;
use App\Models\Mould;
use DB;

class MenuController extends Controller
{
    /**
     * 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->attr['title'] = '菜单管理';
        // $menu_model = new Menu();
        // dd(Menu::getTree());
        $this->attr['data'] = array_flatten_recursive(Menu::getTree());
        // dd($this->attr['data']);
        return view('admin.menu.index', $this->attr);
    }

    /**
     * 添加栏目表单页
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->attr['p_id'] = request('p_id', 0);
        $this->attr['p_id'] && $this->attr['data'] = Menu::getList(true, $this->attr['p_id']);
        $this->attr['mould_list'] = Mould::pluck('name', 'id');//dd($this->attr['mould_list']);
        $this->attr['menu_list'] = array_flatten_recursive(Menu::getTree());
        return view('admin.menu.create', $this->attr);
    }

    /**
     * 更新添加栏目
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menu_model = new Menu();
        $p_id = $request->input('p_id', 0);
        if ($p_id) {
            $p_info = $menu_model->where('id', $p_id)->value('path');
            $path = ($p_info ? "$p_info," : '') . "$p_id";
            $request->merge(['path' => $path]);
        }
        //事务处理
        $menu_info = DB::transaction(function () use ($menu_model, $request) {
            $menu_info = $menu_model->create(
                $request->only($menu_model->fillable)
            );
            if ($request->input('mould_id', 0) == 0 && $request->input('content')) {
                $menu_info->menuContent()->create($request->only(['content']));
            }

            return $menu_info;
        });

        if ($menu_info->id) {
            return $this->success('添加成功', ['id' => $menu_info->id]);
        }

        return $this->error('添加失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Menu $menu)
    // {
    //     dd($menu);
    //     //
    // }

    /**
     * 修改栏目表单页
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $this->attr['data'] = $menu;
        if(!$menu['mould_id']){
            $this->attr['data']['content'] = $menu->menuContent()->content;
        }
        
        $this->attr['mould_list'] = Mould::pluck('name', 'id');
        $this->attr['menu_list'] = array_flatten_recursive(Menu::getTree(0, true, $menu->id));
        return view('admin.menu.edit', $this->attr);
    }

    /**
     * 更新栏目
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        // dd($request->all(), $menu);
        $p_id = $request->input('p_id', 0);
        if ($p_id && $p_id != $menu->p_id) {
            $p_info = Menu::where('id', $p_id)->value('path');
            $path = ($p_info ? "$p_info," : '') . "$p_id";
            $request->merge(['path' => $path]);
        }
        //事务处理
        DB::beginTransaction();
        $menu->update(
            $request->only($menu->fillable)
        );
        
        if(!$menu){
            DB::rollBack();
            return $this->error('更新失败');
        }
        if ($request->input('mould_id', 0) == 0 && $request->input('content')) {
            $res = $menu->menuContent()->create($request->only(['content']));
            if(!$res){
                DB::rollBack();
                return $this->error('更新失败');
            }
        }
        //如果父栏目有修改更新所有子栏目的路径
        if ($p_id && $p_id != $menu->p_id) {
            $res = Menu::where('path', 'like', "{$menu->path},{$menu->id}%")->update(
                ['path' => "REPLACE(`path`, {$menu->path}, $path)"]
            );
            if(!$res){
                DB::rollBack();
                return $this->error('更新失败');
            }
        }
        DB::commit();

        return $this->success('更新成功');
    }

    /**
     * 删除栏目及其所有子栏目
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $like_path = ltrim($menu['path'] . ',' . $menu['id'] . '%', ',');

        $menu->delete();
        $res = Menu::where('path', 'like', $like_path)->delete();

        if($res === false){
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }

    /**
     * 栏目排序
     *
     * @param Request $request
     * @return void
     */
    public function sort(Request $request)
    {
        $data = [];
        foreach ($request->input('sort') as $id => $sort) {
            Menu::where('id', $id)->update(['sort' => intval($sort)]);
        }

        return ['status' => 200, 'message' => '更新成功'];
    }

}
