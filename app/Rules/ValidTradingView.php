<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidTradingView implements Rule
{

    protected $sourceType;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($sourceType)
    {
        $this->sourceType = $sourceType;
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

        if($this->sourceType != 'trading_view') return true;
        
        $re = '/.+tradingview.com\/chart\/.+\/([a-zA-Z0-9]+)-.+/m';
        $str =  $value;

        preg_match($re, $str, $matches); 

        return isset($matches[1]);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return trans('TradeSubsystem/error-messages.trading-view-invalid');
        
    }
    
}
