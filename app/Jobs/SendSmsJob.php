<?php

namespace App\Jobs;

use App\Http\Models\Alert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Overtrue\EasySms\EasySms;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 发送短信默认参数
     * @var array
     */
    protected $data = [
        'content'=>'',
        'to' => '',
        'failures' =>''
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = array_merge($this->data,$data);
    }

    /**
     * Execute the jo//b.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;

        if(!$data['to']){
            return false;
        }

        //短信发送成功 下面函数返回 true 反之 false
        $config = config('easysms');
        $easySms = new EasySms($config);

        try{
            $easySms->send(intval($data['to']), [
                'content'  => '日志警报',
                'template' => 'SMS_141195050',
                'data' => [
                    'content'=> substr($data['content'],0,20)
                ],
            ]);
        }catch(\Throwable $e){
            $data['failures'] = $e->getMessage();
        }

        $data['content'] = '【刘志伟】日志警报：用户'.$data['content'].'可能存在刷号风险，建议立即处理！';
        Alert::create($data);
    }
}
