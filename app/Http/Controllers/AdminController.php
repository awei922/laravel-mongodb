<?php

namespace App\Http\Controllers;

use App\Http\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use MongoDB\BSON\UTCDateTime;

class AdminController extends Controller
{
    //
    public function index()
    {
        $db_info = [];
        $php_info = [];

        $expire = Carbon::now()->addDay(1);

        //检测mysql数据库信息
        if (config('database.default') == 'mysql') {
            if (!Cache::has('db_info')) {
                $db_info['version'] = DB::select("select version() as version;")[0]->version;
                $db_info['max_connections'] = DB::select("show variables like 'max_connections'")[0]->Value;
                $db_info['engine'] = DB::select("show variables like 'default_storage_engine'")[0]->Value;
                $db_info['database'] = config('database.connections.mysql.database');
                $db_info['charset'] = config('database.connections.mysql.charset');
                Cache::put('db_info', $db_info, $expire);
            } else {
                $db_info = Cache::get('db_info');
            }
        }

        //php信息
        if (!Cache::has('php_info')) {
            $php_info['extensions'] = get_loaded_extensions();
            $php_info['disable_functions'] = explode(',', ini_get('disable_functions'));
            Cache::put('php_info', $php_info, $expire);
        } else {
            $php_info = Cache::get('php_info');
        }

        //日志相关
        $openids = Log::raw(function ($collection) {
            return $collection->aggregate([
                ['$match'=>['created_at'=>['$gt'=>new UTCDateTime((strtotime('-7 days')+8*60*60)*1000)]]],
                ['$group' => ['_id' => '$openid', 'openid_cnt' => ['$sum' => 1]]],
                ['$sort' => ['openid_cnt' => -1]],
                ['$limit' => 10]
            ]);
        });

        $phones = Log::raw(function ($collection) {
            return $collection->aggregate([
                ['$match'=>['created_at'=>['$gt'=>new UTCDateTime((strtotime('-7 days')+8*60*60)*1000)]]],
                ['$group' => ['_id' => '$phone', 'phone_cnt' => ['$sum' => 1]]],
                ['$sort' => ['phone_cnt' => -1]],
                ['$limit' => 10]
            ]);
        });

        $data = compact("db_info", "php_info",'openids','phones');

        return view('admin/index')->with($data);
    }
}


