<?php

namespace App\Jobs;

use App\Model\Facades\Trade as TradeFacade;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App;
use Cache;
use Carbon\Carbon;
use Log;

class UpdateTrades implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tradeFacade;
    protected $fromId;
    protected $toId;

    public function __construct($fromId, $toId)
    {
        $this->tradeFacade = new TradeFacade($fromId, $toId);
        $this->fromId = $fromId;
        $this->toId = $toId;
    }

    public function handle()
    {

        if(env('APP_ENV') !== 'testing') 
        {

            if(Cache::has('updating-'.$this->fromId.'-'.$this->toId)) 
            {

                return;

            }

            Cache::put('updating-'.$this->fromId.'-'.$this->toId, true, 1);

        }

        try {

            $this->tradeFacade->updateActiveTrades();

        }catch(\Exception $e)
        {

            Log::error("ERROR");
            Log::error($e);

        }

        try {

            $this->tradeFacade->updateOpenedTrades();

        }catch(\Exception $e)
        {

            Log::error("ERROR");
            Log::error($e);

        }

        if(env('APP_ENV') !== 'testing') 
        {

            Cache::forget('updating-'.$this->fromId.'-'.$this->toId);

        }

    }

}