<?php

namespace App\Listeners;

use App\Events\LogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Models\Config;

class LogConfigListener
{
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
        $logs = $event->log;

        $fileds = array_keys($logs);

        $logAllFields = Config::where('name','logAllFields')->first();
        if($logAllFields){
            $logAllFields = $logAllFields->toArray();
            $fileds = array_keys(array_flip($logAllFields['value'])+array_flip($fileds));  //数组合并
        }

        Config::updateOrInsert(['name'=>'logAllFields'],['value'=>$fileds]);
    }
}
