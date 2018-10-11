<?php
/**
 * Created by PhpStorm.
 * User: A.wei
 * Date: 2018/7/30
 * Time: 14:58
 */

namespace App\Http\Controllers;

use App\Http\Models\Config;

class ConfigController extends Controller
{
    /**
     * 日志配置
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allLogFields()
    {
        //全部字段
        $allFields = Config::where('name','logAllFields')->first();
        if($allFields){
            $allFields = $allFields->value;
        }

        $showFields = Config::where('name','logShowFields')->first();
        if($showFields){
            $showFields = $showFields->value;
        }

        return view('config/allLogFields',compact('allFields','showFields'));
    }

    /**
     * 配置显示字段
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setLogShowFields()
    {
        $fields = request()->except('_token');
        if($fields){
            $fields = array_keys($fields);
            Config::updateOrInsert(['name'=>'logShowFields'],['value'=>$fields]);

            return redirect(route('log.index'));
        }
    }

    /**
     * 警报配置
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function alertConfig()
    {
        $alertConfig = Config::where('name','alertConfig')->first();
        if($alertConfig){
            $alertConfig = $alertConfig->value;
        }
        return view('config/alertConfig',compact('alertConfig'));
    }

    /**
     * 保存警报配置
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doAlertConfig()
    {
        $this->validate(request(),[
                'email'=>'required_if:is_email,true',
                'phone'=>'required_if:is_sms,true',
                'alertNum'=>'required_with:alertField|integer|min:2',
            ],
            [],
            [
                'is_email'=>'启用邮件警报',
                'is_sms'=>'启用短信警报',
                'alertNum'=>'记录数',
                'alertField'=> '警报字段'
            ]
        );

        $alertConfig = request()->except('_token');
        if($alertConfig){
            Config::updateOrInsert(['name'=>'alertConfig'],['value'=>$alertConfig]);

            return redirect(route('alert.index'));
        }
    }

}