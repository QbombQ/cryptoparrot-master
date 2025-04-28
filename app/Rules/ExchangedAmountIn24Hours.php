<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class ExchangedAmountIn24Hours implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  int  $amount
     * @return bool
     */
    public function passes($attribute, $amount)
    {
        
        if($amount > 3000000){

            return false;

        }else{

            return true;

        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You can\'t redeem more than $50,000 play dollars in last 48 hours.';
    }
}
