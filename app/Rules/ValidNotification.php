<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidNotification implements Rule
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

        if(count($value) == 0) return true;

        $notificationTypes = config('custom.notifications');

        foreach($value as $type => $value)
        {

            if(!in_array($type, $notificationTypes)) return false;

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

        return trans('TradeSubsystem/error-messages.notification-invalid');
        
    }
}
