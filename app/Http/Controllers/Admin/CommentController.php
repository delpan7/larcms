<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController as Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\DocumentArticle;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->attr['data'] = Comment::get();

        return view('admin.comment.index', $this->attr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $this->attr['data'] = $comment;
        // dd($this->attr['data']);
        return view('admin.comment.show', $this->attr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function edit(Comment $comment)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Comment $comment)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $res = $comment->delete();

        if($res === false){
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }

    /**
     * 评论审核
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function approval(Request $request, Comment $comment)
    {
        $type = $request->input('type');
        if($type == 'accpet'){
            $comment->status = ($comment->status & ~2) | 1;
        }else{
            $comment->status = ($comment->status & ~1) | 2;
        }
        $res = $comment->save();

        if($res === false){
            return $this->error('审核失败');
        }

        return $this->success('审核成功');
    }
}
