<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Data\Models\UserReward;
use Currency;

class UserRewardObserver
{

    protected $emailService;
    protected $balanceService;
	
    public function __construct(
        EmailServiceInterface $emailService,
        BalanceServiceInterface $balanceService
    )
	{

        $this->emailService = $emailService;
        $this->balanceService = $balanceService;
		
	}    

    public function created(UserReward $userReward)
    {

        $reward = $userReward->reward;
        $user = $userReward->user;
        
        $user->earn_play_dollars_reward_diff -= $reward->price;
        $user->save();
        $reward->quantity -= 1;
        $reward->save();

        $this->balanceService->addAmount($user->id, Currency::dollar()->id, $user->main_portfolio_id, -1 * $reward->price);
        $this->balanceService->updateUsdValues($user->handle);        

        $message = $user->username . " Claims reward : " . $reward->title;

        $this->emailService->sendEmailToAdministratorAboutEvent('claim_reward', [
            'message' => $message
        ]);
		
    }    

}