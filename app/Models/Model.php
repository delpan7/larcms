<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{

    /**
     * 获取可以被批量赋值的属性
     *
     * @return string
     */
    public function getFillableAttribute()
    {
        return $this->fillable;
    }
}
