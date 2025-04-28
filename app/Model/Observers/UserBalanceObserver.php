<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\Common\TokenServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Data\UserBalanceRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\BalanceLogRepositoryInterface;
use Cache;
use App\Model\Data\Models\UserBalance;
use Cookie;

class UserBalanceObserver
{

    protected $balanceService;
    protected $balanceLogRepository;
	
    public function __construct(
        BalanceServiceInterface $balanceService,
        BalanceLogRepositoryInterface $balanceLogRepository
    )
	{
		
        $this->balanceService = $balanceService;
        $this->balanceLogRepository = $balanceLogRepository;
		
	}    
 
    public function updated(UserBalance $userBalance)
    {

        if($userBalance->amount < 0)
        {

            $userBalance->amount = 0;
            $userBalance->save();

        }

        if($userBalance->reserved_amount < 0)
        {

            $userBalance->reserved_amount = 0;
            $userBalance->save();

        }

        Cache::forget('users-for-search');

    }

    public function saved(UserBalance $userBalance)
    {

        if($userBalance->isDirty('amount') || $userBalance->isDirty('reserved_amount'))
        {

            $this->balanceLogRepository->create([
                'user_id' => $userBalance->user_id,
                'currency_id' => $userBalance->currency_id,
                'amount' => $userBalance->amount,
                'reserved_amount' => $userBalance->reserved_amount,
                'usd_value' => $userBalance->usd_value
            ]);

        }
        
    }

}