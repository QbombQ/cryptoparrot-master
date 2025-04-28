<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Data\Models\Currency;
use Auth;
use App;
use Log;

class LimitNotExceeded implements Rule
{

    protected $amount;
    protected $type;
    protected $market;
    protected $total;
    protected $tradePairId;  
    protected $leverage;    

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tradePairId, $type, $amount, $market, $total, $leverage)
    {
        $this->amount = $amount;
        $this->type = $type;
        $this->market = $market;
        $this->total = $total;
        $this->tradePairId = $tradePairId;
        $this->leverage = $leverage;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        //if(!is_numeric($this->total)) return false;
 
        $pairRepository = App::make('App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface');
        $tradeService = App::make('App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface');
        $dollarCurrency = Currency::orderBy('id', 'asc')->first();

        $pair = $pairRepository->get($this->tradePairId);

        if(!$pair) return false;
 
        if($this->type == 'buy' || $this->type == 'long')
        {

            if(!$this->market || $this->market !== 'on')
            {

                $sum = $this->amount;
 
            }else{

                $sum = $this->total / $pair->rate;  

            }   

        } else {

            if(!$this->market || $this->market !== 'on')
            {

                $sum = $this->amount;
  
            }else{

                $sum = $this->total;
            }

        } 

        if($this->leverage != 0)
        {

            $sum *= $this->leverage;

        }

        $totalTradesValuesToday = $tradeService->getTodayTradesValue(Auth::id(), $pair, Auth::user()->current_portfolio_id);

        if($this->type === 'buy' || $this->type === 'long')
        {

            $totalSum = $sum + $totalTradesValuesToday['buy'];
            return $totalSum <= $pair->buy_volume_limit;

        } else {

            $totalSum = $sum + $totalTradesValuesToday['sell'];
            return $totalSum <= $pair->sell_volume_limit;

        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return trans('TradeSubsystem/error-messages.pair-limit-exceeded');
        
    }
}