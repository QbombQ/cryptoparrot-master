<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Data\Models\TradeFee;
use Currency;
use Log;

class TradeFeeObserver
{

    protected $balanceService;
	
    public function __construct(BalanceServiceInterface $balanceService)
	{
		
        $this->balanceService = $balanceService;
		
	}    

    public function created(TradeFee $fee)
    {

        \Log::error("CREATED FOR");
        \Log::error($fee);
        $totalFeesOfThisTrade = TradeFee::where('trade_id', $fee->trade_id)->count();

        if($totalFeesOfThisTrade > 1)
        {

            $fee->delete();
            return;

        }

        $portfolio = $fee->trade->portfolio;

        if($fee->trade->type == 'buy')
        {

            Log::error('buy fee:'.$fee->fee * -1);
            $this->balanceService->addAmount($fee->trade->user_id, $fee->trade->tradePair->fromCurrency->id, $portfolio->id, $fee->fee * -1);

        }elseif($fee->trade->type == 'sell')
        {

            Log::error('sell fee:'.$fee->fee * -1);
            $this->balanceService->addAmount($fee->trade->user_id, $fee->trade->tradePair->toCurrency->id, $portfolio->id, $fee->fee * -1);

        }else{

            if($fee->trade->market){

            Log::error('Apply fee in observer'.$fee->fee);
 
            $this->balanceService->addAmount($fee->trade->user_id, Currency::dollar()->id, $portfolio->id, $fee->fee * -1);

            } 

        }

    }
 
}