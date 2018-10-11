<?php

namespace App\Http\Controllers;

use App\Events\LogEvent;
use App\Http\Models\Config;
use App\Http\Models\Log;
use Carbon\Carbon;

class LogController extends Controller
{
    protected $selectVal = [
    ];

    public function __construct()
    {
        parent::__construct();

        //获取显示的字段
        $fields = Config::where('name','logShowFields')->first();
        if($fields){
            $this->selectVal = $fields->value;
        }
    }

    /**
     * 日志管理
     * @return $this
     */
    public function index()
    {
        $inputs = ['selectVal'=>'','keyWord'=>'','startTime'=>date('Y-m-d',strtotime('-1 day')),'endTime'=>date('Y-m-d')];
        $inputs = array_merge($inputs,request()->all());

        $logs = new Log();
        if($inputs['selectVal'] && ($inputs['keyWord'] || $inputs['selectVal']==0)){
            if($inputs['selectVal'] == 'all'){
                foreach($this->selectVal as $v){
                    if(in_array($inputs['keyWord'],['true','false'])){

                        $temp_keyWord = $inputs['keyWord'] == 'false' ? false : true;
                        $logs = $logs->orWhere($v,$temp_keyWord);

                    }elseif(strlen((int)$inputs['keyWord'])<4 && (int)$inputs['keyWord']>0){

                        $logs = $logs->orWhere($v,(int)$inputs['keyWord']);

                    }else{
                        $logs = $logs->orWhere($v,'like',$inputs['keyWord'].'%');
                    }
                }
            }else{
                if(in_array($inputs['keyWord'],['true','false'])){

                    $temp_keyWord = $inputs['keyWord'] == 'false' ? false : true;
                    $logs = $logs->orWhere($inputs['selectVal'],$temp_keyWord);

                }elseif(strlen((int)$inputs['keyWord'])<4 && (int)$inputs['keyWord']>0){

                    $logs = $logs->orWhere($inputs['selectVal'],(int)$inputs['keyWord']);

                }else{
                    $logs = $logs->orWhere($inputs['selectVal'],'like',$inputs['keyWord'].'%');
                }
            }
        }
        if($inputs['startTime']){
            $logs = $logs->where('created_at','>=',Carbon::parse($inputs['startTime'].' 00:00:00'));
        }
        if($inputs['endTime']){
            $logs = $logs->where('created_at','<=',Carbon::parse($inputs['endTime'].' 23:59:59'));
        }

        $logs = $logs->orderBy('created_at','desc')->paginate(10);
        $logs->appends($inputs);

        //显示字段
        $showFields = $this->selectVal;

        return view('log/index',compact('logs','inputs','showFields'))->with('selectVal',$this->selectVal);
    }

    /**
     * 日志详情
     */
    public function show()
    {
        $data = Log::find(request('id'));

        $this->apiJsonSucc($data);
    }

    /**
     * 日志记录
     */
    public function create()
    {
        $data = file_get_contents("php://input");

        if(empty($data)){
            $this->apiJsonError('内容不能为空');
        }

        if(!is_array($data)){
            $data = json_decode($data,true);
        }

        if(!is_array($data)){
            $this->apiJsonError('数据必须是数组或JSON格式');
        }

        //事件处理
        event(new LogEvent($data));

        if($data = Log::create($data)){
            $this->apiJsonSucc($data);
        }
    }
}
