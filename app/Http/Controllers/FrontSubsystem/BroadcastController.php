<?php

namespace App\Http\Controllers\FrontSubsystem;

use App\Http\Controllers\FrontSubsystem\BaseFrontSubsystemController;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\BroadcastServiceInterface;
use Illuminate\Support\Facades\Request;
use App\Model\Events\CurrencyUpdated;
use Cache;
use Log;
use Carbon\Carbon;
use Currency; 
use App\Model\Data\Models\TradePair;
use App\Model\Data\Models\Currency as CurrencyModel;

class BroadcastController extends BaseFrontSubsystemController
{

    protected $emailService;
    protected $broadcastService;

    public function __construct(
        EmailServiceInterface $emailService,
        BroadcastServiceInterface $broadcastService
    ) 
    {

        $this->emailService = $emailService;
        $this->broadcastService = $broadcastService;
        
    }   
    
    public function broadcastPriceChange()
    {

        return $this->broadcastService->broadcastPriceChange();
 
    }

}
