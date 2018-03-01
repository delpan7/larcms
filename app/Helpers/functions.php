<?php

if (!function_exists('array_flatten_recursive')) {
    /**
     * 将多维数组递归平铺为二维数组
     *
     * @param array $array
     * @param integer $depth 树深度，从0开始
     * @param string $prefix  树形前缀
     * @return void
     */
    function array_flatten_recursive($array, $depth = 0, $prefix = '')
    {
        $result = [];
        $last = end($array);
        foreach ($array as $item) {
            $item = $item instanceof Collection ? $item->all() : $item;

            $children_prefix = '';
            if($depth){
                if($last == $item){
                    $item['tree_name'] = $prefix . '&nbsp;└&nbsp;' . $item['name'];
                    $children_prefix = $prefix . '&nbsp;&nbsp;&nbsp;';
                }else{
                    $item['tree_name'] = $prefix . '&nbsp;├&nbsp;' . $item['name'];
                    $children_prefix = $prefix . '&nbsp;│&nbsp;';
                }
            }else{
                $item['tree_name'] = $item['name'];
            }

            $children_array = [];
            $item['depth'] = $depth;
            $item['has_children'] = 0;
            if (isset($item['children']) && $item['children']) {
                $children_array = array_flatten_recursive($item['children'], $depth+1, $children_prefix);
                unset($item['children']);
                $item['has_children'] = 1;
            }
            $result = array_merge((array)$result, [$item], (array)$children_array);
        }

        return $result;
    }
}

if (!function_exists('array_to_tree')) {
    /**
     * 二维数组转换为多维树
     *
     * @param array $array  数组
     * @param string $pid_key  父ID键名
     * @param integer $mould_id  获取指定模型的菜单
     * @return void
     */
    function array_to_tree($array, $pid_key = 'p_id', $mould_id = 0)
    {
        foreach ($array as $key => &$item) {
            $item = $item instanceof Collection ? $item->all() : $item;

            if($mould_id && $mould_id != $item['mould_id']){
                unset($array[$key]);
            }
            if ($item[$pid_key] && isset($array[$item[$pid_key]])) {
                $array[$item[$pid_key]]['children'][$item['id']] = $item;
                unset($array[$key]);
            }
        }

        return $array;
    }
}