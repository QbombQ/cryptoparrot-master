<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Data\Models\Currency;
use Auth;
use App;

class MinimumTradeValue implements Rule
{

    protected $amount;
    protected $cryptoId;
    protected $type;
    protected $market;
    protected $total;
    protected $tradePairId;  

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($amount, $type, $cryptoId, $market, $total, $tradePairId)
    {

        $this->amount = $amount;
        $this->cryptoId = $cryptoId;
        $this->type = $type;
        $this->market = $market;
        $this->total = $total;
        $this->tradePairId = $tradePairId;

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

        $pairRepository = App::make('App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface');
        $dollarCurrency = Currency::orderBy('id', 'asc')->first();

        $pair = $pairRepository->get($this->tradePairId);

        if(!$pair) return false;
 
        if($this->type == 'buy')
        {

            if(!$this->market || $this->market !== 'on')
            {

                if(!is_numeric($this->amount)) return false;

                $sum = $this->amount * $value;

            } else {

                if(!is_numeric($this->total)) return false;

                $sum = $this->total;

            }

        } else {

            if(!$this->market || $this->market !== 'on')
            {

                if(!is_numeric($this->amount)) return false;

                $sum = $this->amount * $value;

            } else {

                if(!is_numeric($this->total)) return false;

                if($this->type !== 'long')
                {

                    $sum = $this->total * $pair->rate_sell;

                }else{

                    $sum = $this->total * $pair->rate;

                }

            }          

        }

        if($pair->to_currency_id == $dollarCurrency->id)
        {

            return $sum >= 10;

        } else {

            $pair = $pairRepository->getByIds($pair->to_currency_id, $dollarCurrency->id);

            if(!$pair) return false;

            if($this->type == 'buy' || $this->type == 'long')
            {

                return $sum * $pair->rate >= 10;

            }else{

                return $sum * $pair->rate_sell >= 10;

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

        return trans('TradeSubsystem/error-messages.trade-value-too-small');
        
    }
}
