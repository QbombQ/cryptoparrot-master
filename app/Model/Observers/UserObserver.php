<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\Common\TokenServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\PortfolioServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Data\UserBalanceRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserNotificationSettingRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\InvitedUserRepositoryInterface;
use Cache;
use App\Model\Data\Models\User;
use App\Model\Data\Models\Currency;
use Cookie;
use Log;
use Strings;

class UserObserver
{

    protected $tokenService;
    protected $emailService;
    protected $userBalanceRepository;
    protected $userService;
    protected $balanceService;
    protected $userNotificationSettingRepository;
    protected $invitedUserRepository;
    protected $portfolioService;
	
    public function __construct(TokenServiceInterface $tokenService,
                                UserBalanceRepositoryInterface $userBalanceRepository,
                                UserServiceInterface $userService,
                                BalanceServiceInterface $balanceService,
                                UserNotificationSettingRepositoryInterface $userNotificationSettingRepository,
                                InvitedUserRepositoryInterface $invitedUserRepository,
                                PortfolioServiceInterface $portfolioService,
                                EmailServiceInterface $emailService)
	{
		
        $this->tokenService = $tokenService;
        $this->emailService = $emailService;
        $this->userBalanceRepository = $userBalanceRepository;
        $this->userService = $userService;
        $this->balanceService = $balanceService;
        $this->userNotificationSettingRepository = $userNotificationSettingRepository;
        $this->invitedUserRepository = $invitedUserRepository;
        $this->portfolioService = $portfolioService;
		
	}    

    public function created(User $user)
    { 

        Cache::forget('users-for-search');
        $this->userNotificationSettingRepository->create(
            [
                'trade_orders' => 1,
                'comments' => 1,
                'newsletters' => 1,
                'signals' => 1,
                'new_follows' => 1,
                'user_id' => $user->id  
            ]
        );

        $mainPortfolio = $this->portfolioService->create([
            'user_id' => $user->id,
            'title' => 'Main'
        ]);
        $mainPortfolioId = $mainPortfolio['id'];
        $dollarCurrency = Currency::orderBy('id', 'asc')->first();
        $balanceId = $this->userBalanceRepository->createIfDoesNotExist($user->id, $dollarCurrency->id, $mainPortfolioId);
        $this->userBalanceRepository->update($balanceId, ['portfolio_id' => $mainPortfolioId]);
        $this->balanceService->updateUsdValues($user->handle);

        $user->main_portfolio_id = $mainPortfolioId;
        $user->current_portfolio_id = $mainPortfolioId;
        $user->save();

        $invitedBy = \Cookie::get('invited_by');

        if($invitedBy)
        {

            $this->invitedUserRepository->create([
                'user_id' => $invitedBy,
                'invited_user_id' => $user->id
            ]);

        }
        
    }     

    public function saved(User $user)
    {

        Cache::forget('users-for-search');

        if(($user->isDirty('status') && $user->status == 'unconfirmed') || ($user->isDirty('email') && $user->status == 'unconfirmed'))
        {

            $token = $this->tokenService->generateUserRegistrationToken($user);
            $url = url('/verify/') . '/'. $token;
            $this->emailService->sendUserConfirmationEmail($user->email, $url);

        }

        if($user->isDirty('handle') && $user->handle && strlen($user->handle) > 0 && $user->username && strlen($user->username) > 0)
        {

            /*
            $message = 'New user : ' . url('/'.Strings::sanitizeForUrl($user->username));

            if($user->invitedBy)
            {

                $message .= ' Invited by : ' . $user->invitedBy->invitedByUser->username;

            }
            
            $this->emailService->sendEmailToAdministratorAboutEvent('registration', [
                'message' => $message
            ]);
            */

        }
    }

}