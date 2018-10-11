<?php

namespace App\Listeners;

use App\Events\LogEvent;
use App\Http\Models\Config;
use App\Http\Models\Log;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSmsJob;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAlertListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * 配置信息
     * @var
     */
    protected $alertConfig;

    /**
     * 日志信息
     * @var
     */
    protected $log;


    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LogEvent  $event
     * @return void
     */
    public function handle(LogEvent $event)
    {
        //
        $this->log = $logs = $event->log;
        $alertConfig = Config::where('name','alertConfig')->first();
        if($alertConfig){
            $this->alertConfig = $alertConfig= $alertConfig->value;
        }

        //根据字段类型来判断
        if(isset($alertConfig['alertField'])){
            //格林时间相差8小时，减去16小时，就是24小时内
            $time = Carbon::parse(date('Y-m-d H:i:s',strtotime('-16 hours')));

            $count = Log::where($alertConfig['alertField'],strval($logs[$alertConfig['alertField']]))->where('created_at','>=',$time)->count();

            if($count>intval($alertConfig['alertNum'])){
                $this->sendAlert();
            }
        }
    }

    /**
     * 发送警报
     */
    public function sendAlert()
    {
        $alertConfig = $this->alertConfig;
        $log = $this->log;

        //发送邮件
        if(isset($alertConfig['is_email']) && $alertConfig['is_email']){
            //465端口不可用
            $data['content'] = '【刘志伟】日志警报：用户'.$log[$alertConfig['alertField']].'可能存在刷号风险，建议立即处理！';

            $emails = explode(',',$alertConfig['email']);
            foreach($emails as $email){
                $data['to'] = $email;
                dispatch(new SendEmailJob($data));
            }
        }

        //发送短信
        if(isset($alertConfig['is_sms']) && $alertConfig['is_sms']){
            $data['content'] = $log[$alertConfig['alertField']];

            $phones = explode(',',$alertConfig['phone']);
            foreach($phones as $phone){
                $data['to'] = $phone;
                dispatch(new SendSmsJob($data));
            }
        }
    }
}
