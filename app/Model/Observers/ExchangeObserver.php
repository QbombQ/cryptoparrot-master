<?php

namespace App\Model\Observers;

use App\Model\Data\Models\Exchange;
use App\Model\Events\RedeemCompleted;
use App;
use Log;

class ExchangeObserver
{

    public function created(Exchange $exchange)
    {
        
        \Log::error('New Exchange Created');
        event(new RedeemCompleted($exchange));
		
    } 

}