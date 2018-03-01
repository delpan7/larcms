<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class Menu extends Model
{

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['p_id', 'mould_id', 'name', 'path', 'url', 'keywords', 'sort', 'description'];

    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    // protected $guarded = ['id', 'create_at', 'update_at'];

    /**
     * 获取栏目的内容
     */
    public function menuContent()
    {
        return $this->hasOne('App\Models\MenuContent')->withDefault();
    }

    /**
     * 前台菜单列表
     *
     * @param boolean $is_all 获取所有，包含隐藏菜单
     * @param integer $id  获取指定的栏目
     * @return void
     */
    public static function getList($is_all = true, $id = 0)
    {
        $cache_key = __METHOD__ . "_{$is_all}";
        // dd($cache_key);
        $menu_list = Cache::get($cache_key);
        // dd($menu_list);
        if (true || $menu_list === null) {
            $menu_list = self::where(function ($query) use ($is_all) {
                if (!$is_all) $query->show();
            })->orderBy('path', 'desc')->orderBy('sort', 'asc')
                ->select('id', 'name', 'url', 'p_id', 'path', 'sort', 'is_hide', 'mould_id', 'content_count')
                ->get()->keyBy('id')->toArray();

            Cache::forever($cache_key, $menu_list);
        }

        return $id ? $menu_list[$id] : $menu_list;
    }

    /**
     * 前台菜单列表
     *
     * @param integer $p_id  获取子栏目
     * @param boolean $is_all 获取所有，包含隐藏菜单
     * @param array|string $filter 要过滤的栏目
     * @return void
     */
    public static function getTree($p_id = 0, $is_all = true, $filter = [])
    {
        $menu_list = self::getList($is_all);
        $menu_tree = array_to_tree($menu_list);//数组转树
        // dd($menu_list, $menu_tree);
        if ($p_id) {//取指定栏目下的子栏目
            $path = explode(',', $menu_list[$p_id]['path']);
            array_push($path, $p_id);

            foreach ($path as $path_id) {
                $menu_tree = $menu_tree[$path_id]['children'];
            }
        }

        //过滤栏目
        if ($filter) {
            if (!is_array($filter)) $filter = explode(',', $filter);
            foreach ($filter as $id) {
                $path = explode(',', $menu_list[$id]['path']);
                array_push($path, $id);

                //dot号拼出要过滤的栏目key路径
                $filter_key = '';
                foreach ($path as $path_id) {
                    $filter_key .= $filter_key ? ".children.{$path_id}" : $path_id;
                }

                array_forget($menu_tree, $filter_key);//去掉要过滤的栏目
            }
        }
        // dd($menu_tree);

        return $menu_tree;
    }

    /**
     * 获取指定模型的分类
     *
     * @param integer $mould_id  指定模型ID，默认值1
     * @return void
     */
    public static function getDocumentMenuList($mould_id = 1)
    {
        $menu_list = self::getList();
        $menu_tree = array_flatten_recursive(array_to_tree($menu_list, 'p_id', $mould_id));//数组转树

        return $menu_tree;
    }

    /**
     * 过滤隐藏菜单
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeShow($query)
    {
        return $query->where('is_hide', 0);
    }


}
