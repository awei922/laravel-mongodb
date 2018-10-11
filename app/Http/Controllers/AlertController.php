<?php
/**
 * Created by PhpStorm.
 * User: A.wei
 * Date: 2018/7/31
 * Time: 16:03
 */

namespace App\Http\Controllers;

use App\Http\Models\Alert;
use Carbon\Carbon;
class AlertController extends Controller
{
    protected $selectVal = [
        'to'=>'To',
        'content' => 'Content'
    ];

    /**
     * 日志管理
     * @return $this
     */
    public function index()
    {
        $inputs = ['selectVal'=>'','keyWord'=>'','startTime'=>date('Y-m-d',strtotime('-1 day')),'endTime'=>date('Y-m-d')];
        $inputs = array_merge($inputs,request()->all());

        $alerts = new Alert();
        if($inputs['selectVal'] && $inputs['keyWord']){
            if($inputs['selectVal'] == 'all'){
                foreach($this->selectVal as $k=>$v){
                    $alerts = $alerts->orWhere($k,'like','%'.$inputs['keyWord'].'%');
                }
            }else{
                $alerts = $alerts->where($inputs['selectVal'],'like','%'.$inputs['keyWord'].'%');
            }
        }
        if($inputs['startTime']){
            $alerts = $alerts->where('created_at','>=',Carbon::parse($inputs['startTime'].' 00:00:00'));
        }
        if($inputs['endTime']){
            $alerts = $alerts->where('created_at','<=',Carbon::parse($inputs['endTime'].' 23:59:59'));
        }

        $alerts = $alerts->orderBy('created_at','desc')->paginate(10);
        $alerts->appends($inputs);

        return view('alert/index',compact('alerts','inputs'))->with('selectVal',$this->selectVal);
    }
}