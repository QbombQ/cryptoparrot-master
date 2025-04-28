<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Data\Models\Currency;
use Auth;
use App;

class LeverageMoreThanZero implements Rule
{

    protected $aboveLimit; 
    protected $belowLimit; 

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($aboveLimit, $belowLimit)
    {
        $this->aboveLimit = $aboveLimit;
        $this->belowLimit = $belowLimit;
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

        if($value != 0) return true;

        if($this->aboveLimit != 0  || $this->belowLimit != 0)
        {

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

        return trans('TradeSubsystem/error-messages.conditional-close-leverage');
        
    }
}
