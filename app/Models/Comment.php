<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * 获得此评论所属的文章。
     */
    public function document()
    {
        return $this->belongsTo('App\Models\Document');
    }

    /**
     * 获得此评论所属的用户。
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
