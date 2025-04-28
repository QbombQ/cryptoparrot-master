<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Data\Models\Currency;
use Auth;
use App;

class HigherThanFee implements Rule
{

    protected $amount;
    protected $cryptoId;
    protected $type;
    protected $market;
    protected $total;
    protected $tradePairId; 
    protected $leverage;    
    protected $price;    

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($amount, $type, $cryptoId, $market, $total, $tradePairId, $leverage, $price)
    {

        $this->amount = $amount;
        $this->cryptoId = $cryptoId;
        $this->type = $type;
        $this->market = $market;
        $this->total = $total;
        $this->tradePairId = $tradePairId;
        $this->leverage = $leverage;
        $this->price = $price;

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

        if(!$this->leverage || $this->leverage == 0)
        {

            return true;

        }

        $pairRepository = App::make('App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface');

        $pair = $pairRepository->get($this->tradePairId);

        if(!$pair) return false;

        if($this->type == 'buy' || $this->type == 'long')
        {

            if(!$this->market || $this->market !== 'on')
            {

                return $value > $this->price;

            } else {

                return $value > $pair->rate;

            }

        } else {

            if(!$this->market || $this->market !== 'on')
            {

                return $value > $this->price;

            } else {
                return $value > $pair->rate_sell;

            }

        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return trans('TradeSubsystem/error-messages.above-limit-too-small');
        
    }
}
