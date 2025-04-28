<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BlockedUserServiceInterface;
use Auth;

class BlockedUsersPageController extends BaseTradeSubsystemController
{

    protected $blockedUserService;

    public function __construct(
        UserFormatterInterface $userFormatter,
        BlockedUserServiceInterface $blockedUserService
    ) 
	{

        parent::__construct($userFormatter);
        $this->blockedUserService = $blockedUserService;
		
	}    

	public function main()
	{

        parent::getCommonData(); 
		$this->data['blockedUsers'] = $this->blockedUserService->paginate(Auth::id());

		return view($this->viewWithPrefix('blocked-users'), $this->data);
		
	}

}