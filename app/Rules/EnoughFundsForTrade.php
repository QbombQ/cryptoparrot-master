<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use App;

class EnoughFundsForTrade implements Rule
{

    protected $amount;
    protected $cryptoId;
    protected $type;
    protected $market;
    protected $total;
    protected $tradePairId;
    protected $portfolioId;    

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($amount, $type, $cryptoId, $market, $total, $tradePairId, $portfolioId)
    {

        $this->amount = $amount;
        $this->cryptoId = $cryptoId;
        $this->type = $type;
        $this->market = $market;
        $this->total = $total;
        $this->tradePairId = $tradePairId;
        $this->portfolioId = $portfolioId;

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

        if($this->portfolioId === null) return false;

        if($this->market && $this->market == 'on')
        {

            return $this->validateMarket();

        }

        return $this->validateLimit($value);

    }

    private function validateMarket() 
    {

        $tradePairRepository = \App::make('App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface');
        $tradePair = $tradePairRepository->get($this->tradePairId);

        $balance = $this->type !== 'sell' ? 
            Auth::user()->balances->where('currency_id', $tradePair->to_currency_id)->where('portfolio_id', $this->portfolioId)->first() :
            Auth::user()->balances->where('currency_id', $tradePair->from_currency_id)->where('portfolio_id', $this->portfolioId)->first();

        if(!$balance) return false;

        if($this->type == 'short')
        {

            $currencyRepository = App::make('App\Model\Contracts\Interfaces\Data\CurrencyRepositoryInterface');
            $currency = $currencyRepository->get($tradePair->from_currency_id);
            return ($balance->amount - $balance->reserved_amount) >= $this->total * $currency->usd_value;

        } else {

            return ($balance->amount - $balance->reserved_amount) >= $this->total;

        }

    }

    private function validateLimit($value)
    {

        $currencyRepository = App::make('App\Model\Contracts\Interfaces\Data\CurrencyRepositoryInterface');
        
        if(!is_numeric($this->amount) || !is_numeric($value) || $this->amount === 0 || $value === 0) return true;
        
        if($this->type == 'buy' || $this->type == 'long')
        {

            $total = $this->amount * $value;

        } else if($this->type == 'sell')
        {

            $total = $this->amount;

        } else {

            $currency = $currencyRepository->get($this->cryptoId);
            $total = $this->amount * $value * $currency->usd_value;

        }
        
        $balance = Auth::user()->balances->where('currency_id', $this->cryptoId)->where('portfolio_id', $this->portfolioId)->first();
        
        if(!$balance) return false;
        
        return ($balance->amount - $balance->reserved_amount) >= $total;        

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return trans('TradeSubsystem/error-messages.not-enough-funds');
        
    }
}
