<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidSocialNetwork implements Rule
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
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        $socialNetworks = config('custom.social_networks');

        foreach($value as $network => $url)
        {

            if(!in_array($network, $socialNetworks)) return false;

        }

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return trans('TradeSubsystem/error-messages.social-network-invalid');
        
    }
}
