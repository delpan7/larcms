<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController as Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Menu;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->attr['data'] = Document::get();
        // dd($this->attr['data']);
        return view('admin.article.index', $this->attr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->attr['menu_id'] = $request->input('menu_id', 0);
        // $this->attr['p_id'] = request('p_id', 0);
        // $this->attr['p_id'] && $this->attr['data'] = Menu::getList(true, $this->attr['p_id']);
        // $this->attr['mould_list'] = Mould::pluck('name', 'id');//dd($this->attr['mould_list']);
        $this->attr['menu_list'] = Menu::getDocumentMenuList();
        return view('admin.article.create', $this->attr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mould_id = $request->input('mould_id', 0);
        $menu_id = $request->input('menu_id', 0);
        $menu_info = Menu::find($menu_id);
        if($menu_info['mould_id'] != $mould_id){
            return $this->error('模型与分类对应错误，请重新选择分类');
        }
        $document_model = new Document();
        //事务处理
        $document_info = DB::transaction(function () use ($document_model, $request) {
            $document_info = $document_model->create(
                $request->only($document_model->fillable)
            );
            
            $document_info->documentArticle()->create($request->only(['content']));
            

            return $document_info;
        });

        if ($document_info->id) {
            return $this->success('添加成功', ['id' => $document_info->id]);
        }

        return $this->error('添加失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $this->attr['data'] = $document;
        $this->attr['data']['content'] = $document->documentArticle()->document;
        
        $this->attr['menu_list'] = Menu::getDocumentMenuList();
        return view('admin.menu.edit', $this->attr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $mould_id = $request->input('mould_id', 0);
        $menu_id = $request->input('menu_id', 0);
        $menu_info = Menu::find($menu_id);
        if($menu_info['mould_id'] != $mould_id){
            return $this->error('模型与分类对应错误，请重新选择分类');
        }
        // $document_model = new Document();
        //事务处理
        DB::transaction(function () use ($document_model, $request) {
            $document->update(
                $request->only($document->fillable)
            );
            
            $document->documentArticle()->update($request->only(['content']));
        });

        return $this->success('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {

        $res = $document->delete();

        if($res === false){
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }

    /**
     * 回收站
     *
     * @return \Illuminate\Http\Response
     */
    public function recycle()
    {
        $this->attr['data'] = Document::onlyTrashed()->get();
        return view('admin.article.recycle', $this->attr);
    }

    /**
     * 从回收站恢复文章
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function restore(Document $document)
    {
        $res = $document->restore();
        if($res === false){
            return $this->error('恢复失败');
        }

        return $this->success('恢复成功');
    }
}
