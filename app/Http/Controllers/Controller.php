<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        View::share('currentUri',Request::getUri());
    }

    /**
     * Api返回成功json格式
     * @param $data
     * @param int $status
     * @param string $msg
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function apiJsonSucc($data, $status = 0, $msg='')
    {
        if(empty($data)){
            return false;
        }

        $res = [
            'status' => $status,
            'data' => $data
        ];

        if($msg){
            $res = array_merge($res,['msg'=>$msg]);
        }
        exit(json_encode($res));
    }

    /**
     * Api返回错误json格式
     * @param $msg
     * @param int $status
     * @param null $data
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function apiJsonError($msg, $status = -1, $data = null)
    {
        if(empty($msg)){
            return false;
        }

        $res = [
            'status' => $status,
            'msg' => $msg
        ];

        if($data){
            $res = array_merge($res,['data'=>$data]);
        }
        exit(json_encode($res));
    }

}
