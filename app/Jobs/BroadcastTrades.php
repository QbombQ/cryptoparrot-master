<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Model\Events\NewTrade;

class BroadcastTrades implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $trade;

    public function __construct($trade)
    {
        $this->trade = $trade;
    }

    public function handle()
    {

        if($this->trade->author->ghosted === 1) 
        {
            
            return;

        }

        event(new NewTrade($this->trade->id));
        
    }

    public function markAsFailed(){}
    public function hasFailed() {}
    public function isReleased() {}

}
