<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use App;

class EnoughFunds implements Rule
{

    public function passes($attribute, $value)
    {

        $rewardService = App::make('App\Model\Contracts\Interfaces\Services\TradeSubsystem\RewardServiceInterface');
        $userAmountLeft = $rewardService->amountLeft(Auth::user());

        if($userAmountLeft < $value)
        {

            return false;

        }

        return true;

    }

    public function message()
    {

        return trans('TradeSubsystem/error-messages.not-enough-funds');
        
    }
}
