<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\InvitedUserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\InvitedUserFormatterInterface;
use Cookie;
use Auth;

class InvitedUserService implements InvitedUserServiceInterface
{

    protected $invitedUserFormatter;
    protected $userService;

    public function __construct(
        InvitedUserFormatterInterface $invitedUserFormatter,
        UserServiceInterface $userService
    )
    {

        $this->invitedUserFormatter = $invitedUserFormatter;
        $this->userService = $userService;

    }

    public function getInvitedUsers($user)
    {

        $invitedUsers = $user->invitedUsers;
        
        return $this->invitedUserFormatter->prepareInvitedUsersForDisplay($invitedUsers);

    }

    public function followIfInvited()
    {

        $invitedBy = Cookie::get('invited_by');

		if($invitedBy) 
		{

            $this->userService->follow($invitedBy, Auth::id());
			Cookie::forget('invited_by');
			
        }

    }

}