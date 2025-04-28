<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use App;

class UserIpUsedInRewards implements Rule
{

    public function passes($attribute, $value)
    {

    	$exchangeRepository = \App::make('App\Model\Contracts\Interfaces\Data\ExchangeRepositoryInterface');
    	$count = $exchangeRepository->getOtherUserExchangesWithMatchingIp(Auth::user()->ip,Auth::user()->id);

        if($count)
        {

            return false;

        }

        return true;

    }

    public function message()
    {

        return 'Looks like you are utilizing multiple accounts to cheat the rewards system. We are actively banning such users. If you think this is a mistake email rewards@cryptoparrot.com';
        
    }
} 
