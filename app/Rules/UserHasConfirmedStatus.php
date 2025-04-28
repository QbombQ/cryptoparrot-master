<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use App;

class UserHasConfirmedStatus implements Rule
{

    public function passes($attribute, $value)
    {

        if(Auth::user()->status != 'confirmed')
        {

            return false;

        }

        return true;

    }

    public function message()
    {

        return 'You need to confirm your email in order to claim a reward';
        
    }
}
