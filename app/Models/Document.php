<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['menu_id', 'mould_id', 'title', 'thumb', 'keywords', 'description'];

    /**
     * 获文章的内容
     */
    public function documentArticle()
    {
        return $this->hasOne('App\Models\DocumentArticle')->withDefault();
    }
}
