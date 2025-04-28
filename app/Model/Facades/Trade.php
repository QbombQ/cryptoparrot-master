<?php

namespace App\Model\Facades;

use App\Model\Contracts\Interfaces\Data\TradeRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface;
use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeFeeServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Data\TradeVoteRepositoryInterface;
use App\Model\Data\Models\Currency;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\MassEmail;
use App;
use Cache;
use Carbon\Carbon;
use Log;

class Trade {

    protected $fromId;
    protected $toId;

    protected $tradeRepository;
    protected $tradePairRepository;
    protected $balanceService;
    protected $tradeFeeService;
    protected $dollarCurrency;
    protected $notificationService;
    protected $tradeService;

    protected $debt;
    protected $priceWhenClosed;
    protected $profit;
    protected $edgeToReach;

    protected $trade;

    const TRADE_NOT_EXECUTED_NOTIFICATION_ID = 17;

    public function __construct($fromId = null, $toId = null)
    {
        $this->fromId = $fromId;
        $this->toId = $toId;
        $this->initiateDependencies();
    }

    private function initiateDependencies()
    {

        $this->tradeRepository = App::make(TradeRepositoryInterface::class);
        $this->tradePairRepository = App::make(TradePairRepositoryInterface::class);
        $this->balanceService = App::make(BalanceServiceInterface::class);
        $this->tradeFeeService = App::make(TradeFeeServiceInterface::class);
        $this->dollarCurrency = Currency::orderBy('id', 'asc')->first();  
        $this->notificationService = App::make(NotificationServiceInterface::class);        
        $this->tradeService = App::make(TradeServiceInterface::class);        

    }

    public function updateOpenedTrades()
    {

        $tradePair = $this->tradePairRepository->getByIds($this->fromId, $this->toId);

        $openedTrades = $this->tradeRepository->getOpenedTrades($tradePair->id);
            
        if($openedTrades->count() > 0) {

            foreach($openedTrades as $trade) {

                $this->updateOpenedTrade($trade);

            }

        }  

    }

    public function updateActiveTrades()
    {

        $tradePair = $this->tradePairRepository->getByIds($this->fromId, $this->toId);

        $activeTrades = $this->tradeRepository->getActiveTrades($tradePair->id);

        if($activeTrades->count() > 0) {

            foreach($activeTrades as $trade) {

                if($trade->market != 1)
                {                   

                    $this->updateActiveTrade($trade);
                
                }

            }

        }

    }

    public function finishTrade($trade)
    {

        \Log::error("FINISHING TRADE");
        $this->recalculateVariables($trade);
        $this->takeTradeActionBasedOnType($trade);
        \Log::error("FINISHED");

    }

    private function recalculateVariables($trade)
    {

        $this->trade = $trade;

        if(!$trade->leverage) $trade->leverage = 1;

        $this->debt = $trade->amount / $trade->leverage * $trade->target_price;
        $this->priceWhenClosed = 0;
        $initialValue = $trade->amount * $trade->target_price;
        $income = 0;

        if($trade->type == 'long' || $trade->type == 'short') {

            $income = $trade->amount * $trade->tradePair->fromCurrency->usd_value;
            $this->priceWhenClosed = $trade->tradePair->fromCurrency->usd_value;

        }

        $this->profit = $trade->type == 'long' ? ($income - $initialValue) : ($initialValue - $income);
        $tradeFee = $trade->tradeFee ? $trade->tradeFee->fee : 0;
        $this->profit -= $tradeFee;
        $this->edgeToReach = $this->debt * -1;

    }

    private function prepareOpenedTradeForFinish($trade, $amount)
    {

        \Log::error("UPDATING");

        $this->tradeRepository->update(
            $trade->id,
            [
                'target_price' => $this->priceWhenClosed,
                'profit' => $this->profit,
                'reserved_sum' => $trade->reserved_sum - $this->debt,
                'reserve_released' => $trade->reserve_released + 1
            ]
        );
        $this->balanceService->release(
            $trade->user_id,
            $this->dollarCurrency->id,
            $trade->portfolio_id,
            $this->debt
        );
        $this->balanceService->addAmount($trade->user_id, $this->dollarCurrency->id, $trade->portfolio_id, $amount);
        $this->balanceService->updateUsdValues($trade->author->handle);

    }

    private function checkForLimitReach($trade)
    {

        $tradeCondition = $trade->tradeCondition;  

        if($tradeCondition) {

            if(
                ($tradeCondition->below_limit && $this->priceWhenClosed <= $tradeCondition->below_limit) ||
                ($tradeCondition->above_limit && $this->priceWhenClosed >= $tradeCondition->above_limit)
            ) {

                $this->prepareOpenedTradeForFinish($trade, $this->profit);
                $this->tradeRepository->finish($trade->id);

            }

        }

    } 

    private function checkForLiquidation($trade)
    {

        if($this->profit <= $this->edgeToReach) {
            
            $this->prepareOpenedTradeForFinish($trade, ($this->debt * -1));                   
            $this->tradeRepository->liquidate($trade->id);

            return true;

        }

        return false;

    }

    private function updateOpenedTrade($trade)
    {

        try {

            $this->recalculateVariables($trade);
            $liquidated = $this->checkForLiquidation($trade);

            if(!$liquidated) {

                $this->checkForLimitReach($trade);

            }

        }catch(\Exception $e)
        {

            Log::error("ERROR");
            Log::error($e);
            Log::error($trade);

        }

    }

    private function sendNotificationAboutLimitExceeded($trade)
    {

        $targetDate = \Carbon\Carbon::now()->subDays(1);
        $notifications = $trade->notifications;
        $latestNotification = $notifications->count() > 0 ? $notifications->first() : null;

        if(!$latestNotification || $latestNotification->created_at <= $targetDate) 
        {

            $this->notificationService->createNotification(
                $trade->user_id,
                self::TRADE_NOT_EXECUTED_NOTIFICATION_ID, 
                'Tradee did not execute because of liquidity limit.',
                url($trade->author->handle).'/trade/'.$trade->id,
                'Trade', $trade->id
            );
        
        }

    }

    private function exceededDailyLimit($trade)
    {

        $pair = $trade->tradePair;

        if($trade->type == 'buy' || $trade->type == 'long')
        {

            if(!$trade->market || $trade->market !== 'on')
            {

                $sum = $trade->amount;
        
            }else{

                $sum = $trade->total / $pair->rate;
     
            }  

        } else {

            if(!$trade->market || $trade->market !== 'on')
            {

                $sum = $trade->amount;

            }else{

                $sum = $trade->total;
          
            }

        }  

        /* if($trade->leverage != 0)
        {

            $sum *= $trade->leverage;

        } */ 

        $totalTradesValuesToday = $this->tradeService->getTodayTradesValue($trade->user_id, $pair, $trade->portfolio_id);

        if($trade->type === 'buy' || $trade->type === 'long')
        {

            $totalSum = $sum + $totalTradesValuesToday['buy'];

            return $totalSum > $pair->buy_volume_limit;

        } else { 

            $totalSum = $sum + $totalTradesValuesToday['sell'];
            return $totalSum > $pair->sell_volume_limit;

        }

    }

    private function updateActiveLongStopTrade($trade)
    {

        $pair = $trade->tradePair;
        $this->balanceService->release(
            $trade->user_id,
            $this->dollarCurrency->id,
            $trade->portfolio_id,
            $trade->amount / $trade->leverage * $trade->target_price
        );                    
        $this->tradeRepository->update(
            $trade->id,
            [
                'status' => 'open',
                'target_price' => $pair->rate,
                'open_price' => $pair->rate,
                'reserved_sum' => $trade->reserved_sum - ($trade->amount / $trade->leverage * $pair->rate)
            ]
        );
        $this->balanceService->reserve($trade->author->id, $this->dollarCurrency->id, $trade->portfolio_id, $trade->amount / $trade->leverage * $pair->rate);
        $this->balanceService->updateUsdValues($trade->author->handle);
        //$this->tradeFeeService->create($trade);

    } 

    private function updateActiveLongTrade($trade)
    {

        $pair = $trade->tradePair;
        $reservedAmount = $trade->amount / $trade->leverage * $trade->target_price;     
        $amount = $reservedAmount / $pair->rate * $trade->leverage;
        $this->tradeRepository->update(
            $trade->id,
            [
                'status' => 'open',
                'open_price' => $pair->rate,
                'target_price' => $pair->rate,
                'amount' => $amount
            ]
        ); 
        //$this->tradeFeeService->create($trade);

    }

    private function updateShortTrade($trade)
    {

        $pair = $trade->tradePair;
        $reservedAmount = $trade->amount / $trade->leverage * $trade->target_price;     
        $amount = $reservedAmount / $pair->rate_sell * $trade->leverage;
        $this->tradeRepository->update(
            $trade->id,
            [
                'status' => 'open',
                'open_price' => $pair->rate_sell,
                'target_price' => $pair->rate_sell,
                'amount' => $amount
            ]
        );
        //$this->tradeFeeService->create($trade);

    }

    private function updateActiveTrade($trade)
    {

        if(!$this->edgeReached($trade)) 
        {

            return;

        }

        if($this->exceededDailyLimit($trade)) 
        {
 
            $this->sendNotificationAboutLimitExceeded($trade);

            return;

        }

        $this->takeTradeActionBasedOnType($trade);

    }

    private function takeTradeActionBasedOnType($trade)
    {

        switch($trade->type) 
        {
            case 'buy':
                $this->buy($trade);
                break;
            case 'sell':
                $this->sell($trade);
                break;
            case 'long':
                if($trade->stop == 0) {
                    $this->updateActiveLongStopTrade($trade);
                } else {
                    $this->updateActiveLongTrade($trade);
                }
                break;
            case 'short': 
                $this->updateShortTrade($trade);
                break;
        }

    }

    private function updateBuyStopTrade($trade)
    {

        $pair = $trade->tradePair;
        $this->balanceService->addAmount($trade->user_id, $pair->from_currency_id, $trade->portfolio_id, $trade->amount);
        $this->balanceService->addAmount($trade->user_id, $pair->to_currency_id, $trade->portfolio_id, $trade->amount * $pair->rate * -1);
        $this->tradeRepository->update(
            $trade->id, 
            [
                'target_price' => $pair->rate,
                'status' => 'finished',
                'reserved_sum' => $trade->reserved_sum - ($trade->amount * $trade->target_price),
                'reserve_released' => $trade->reserve_released + 1
            ]
        ); 

    }

    private function updateBuyTrade($trade)
    {

        $pair = $trade->tradePair;
        $reservedAmount = $trade->amount * $trade->target_price;
        $amount = $reservedAmount / $pair->rate;
        $this->balanceService->addAmount($trade->user_id, $pair->from_currency_id, $trade->portfolio_id, $amount);
        $this->balanceService->addAmount($trade->user_id, $pair->to_currency_id, $trade->portfolio_id, $trade->amount * $trade->target_price * -1);
        $this->tradeRepository->update(
            $trade->id,
            [
                'target_price' => $pair->rate,
                'status' => 'finished',
                'amount' => $amount,
                'reserved_sum' => $trade->reserved_sum - ($trade->amount * $trade->target_price),
                'reserve_released' => $trade->reserve_released + 1
            ]
        );

    }

    private function buy($trade)
    {

        $pair = $trade->tradePair;

        if($trade->stop == 0)
        {

            $this->updateBuyStopTrade($trade);

        } else {

            $this->updateBuyTrade($trade);

        }

        $this->balanceService->release($trade->user_id, $pair->to_currency_id, $trade->portfolio_id, $trade->amount * $trade->target_price);

    }

    private function sell($trade)
    {

        $pair = $trade->tradePair;

        if($trade->stop == 0) 
        {

            $this->balanceService->addAmount($trade->user_id, $pair->to_currency_id, $trade->portfolio_id, $pair->rate_sell * $trade->amount);

        } else {

            $this->balanceService->addAmount($trade->user_id, $pair->to_currency_id, $trade->portfolio_id, $pair->rate_sell * $trade->amount);

        } 

        $this->balanceService->addAmount($trade->user_id, $pair->from_currency_id, $trade->portfolio_id, $trade->amount * -1);
        $this->balanceService->release($trade->user_id, $pair->from_currency_id, $trade->portfolio_id, $trade->amount);
        $this->tradeRepository->update(
            $trade->id,
            [
                'target_price' => $pair->rate_sell,
                'status' => 'finished',
                'reserved_sum' => $trade->reserved_sum - $trade->amount,
                'reserve_released' => $trade->reserve_released + 1
            ]
        );

    }

    private function edgeReached($trade)
    {

        if($trade->stop == 0) 
        {

            if($trade->type == 'buy' || $trade->type == 'long') 
            {

                return $trade->tradePair->rate <= $trade->target_price;

            } else {

                return $trade->tradePair->rate_sell >= $trade->target_price;

            }

        } else {

            if($trade->type == 'buy' || $trade->type == 'long') 
            {
 
                return $trade->tradePair->rate >= $trade->target_price;

            } else {
 
                return $trade->tradePair->rate_sell <= $trade->target_price;

            }

        }

    }

}