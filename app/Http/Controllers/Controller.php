<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 成功提示
     *
     * @param string $message
     * @param array $data
     * @return void
     */
    public function success($message = '查询成功', $data = []){
        $response_data = [
            'status' => 200,
            'message' => $message
        ];
        $data && $response_data['data'] = $data;
        if(request()->ajax()){
            return $response_data;
        }
        return view('public.success', $response_data);
    }

    /**
     * 失败提示
     *
     * @param  string $message
     * @return void
     */
    public function error($message = '参数错误'){
        if(request()->ajax()){
            return [
                'status' => 500,
                'message' => $message,
            ];
        }
        return view('public.error', ['message' => $message]);
    }
}
