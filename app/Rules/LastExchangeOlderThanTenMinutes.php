<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;


class LastExchangeOlderThanTenMinutes implements Rule
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
     * @param  date  $created_at
     * @return bool
     */
    public function passes($attribute, $created_at)
    {
        
        if(!$created_at) return true;

        $lastExchangeDate = Carbon::parse($created_at);
        $secondsAgo = $lastExchangeDate->diffInSeconds();

        if($secondsAgo < 3600){

            return false; 

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
        return 'Slow down, you are allowed to redeem every hour';
    } 
} 
