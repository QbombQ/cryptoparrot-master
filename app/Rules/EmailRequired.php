<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use Auth;
use App;

class EmailRequired implements Rule
{

    protected $method;

    public function __construct($method = null)
    {
        $this->method = $method;
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

        if($this->method === 'reddit' || $this->method === 'steemit')
        {

            return true;

        }

        return strlen($value) > 0;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return 'Email is required';
        
    }
}
