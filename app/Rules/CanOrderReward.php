<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use App;

class CanOrderReward implements Rule
{

    protected $orderedInPastWeek;

    public function passes($attribute, $value)
    {

        $this->orderedInPastWeek = false;

        $userRewardsRepository = App::make('App\Model\Contracts\Interfaces\Data\UserRewardsRepositoryInterface');

        if($userRewardsRepository->userOrderedInDays(Auth::id(), 7))
        {

            $this->orderedInPastWeek = true;
            return false;

        }

        $userFormatter = App::make('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface');
        $profileData = $userFormatter->prepareUserForProfilePage(Auth::user());
        
        if(Auth::user()->trades->count() < 15 || $profileData['averageProfitLoss'] < 0.05)
        {

            return false;

        }

        return true;

    }

    public function message()
    {

        if($this->orderedInPastWeek)
        {

            return trans('TradeSubsystem/error-messages.ordered-in-week');

        }else
        {

            return trans('TradeSubsystem/error-messages.minimum-requirements-order');

        }
        
    }
}
