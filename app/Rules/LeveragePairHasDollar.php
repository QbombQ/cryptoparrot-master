<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use App;
use App\Model\Data\Models\Currency;

class LeveragePairHasDollar implements Rule
{

    protected $tradePairId; 

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tradePairId)
    {
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

        if($value == 0)
        {

            return true;

        }

        $tradePairRepository = \App::make('App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface');
        $tradePair = $tradePairRepository->get($this->tradePairId);
        $dollarCurrency = Currency::orderBy('id', 'asc')->first();
        
        return $tradePair->from_currency_id == $dollarCurrency->id || $tradePair->to_currency_id == $dollarCurrency->id;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return trans('TradeSubsystem/error-messages.leverage-usd-required');
        
    }
}
