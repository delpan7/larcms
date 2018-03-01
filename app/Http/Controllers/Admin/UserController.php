<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController as Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->attr['data'] = User::get();
        // dd($this->attr['data']);
        return view('admin.user.index', $this->attr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create', $this->attr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_model = new User();
        $user_info = $user_model->create(
            $request->only($user_model->fillable)
        );

        if ($user_info->id) {
            return $this->success('添加成功', ['id' => $user_info->id]);
        }

        return $this->error('添加失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function show(User $user)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->attr['data'] = $user;
        return view('admin.user.edit', $this->attr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $res = $user->update(
            $request->only($user_model->fillable)
        );

        if ($res === false) {
            return $this->error('更新失败');
        }

        return $this->success('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $res = $user->delete();

        if($res === false){
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}
