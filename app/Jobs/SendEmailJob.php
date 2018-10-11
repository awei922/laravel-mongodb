<?php

namespace App\Jobs;

use App\Http\Models\Alert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 发送邮件默认参数
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $data = $this->data;

        if(!$data['to']){
            return false;
        }

        try{
            \Mail::raw($data['content'],function($msg) use ($data){
                $msg->subject('日志警报');
                $msg->to($data['to']);
            });
        }catch(\Throwable $e){
            //判断是否发送成功
            $data['failures'] = $e->getMessage();
        }
        Alert::create($data);
    }
}
