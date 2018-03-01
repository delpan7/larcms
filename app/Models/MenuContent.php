<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuContent extends Model
{
    
    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['content'];

    /**
     * 根据内容获取栏目
     */
    // public function menu()
    // {
    //     return $this->belongsTo('App\Models\Menu');
    // }
}
