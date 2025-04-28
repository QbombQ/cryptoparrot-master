<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;

class FollowController extends BaseTradeSubsystemController
{

	protected $userService;

	public function __construct(UserFormatterInterface $userFormatter, UserServiceInterface $userService) 
	{

		parent::__construct($userFormatter);
		$this->userService = $userService;
		
	}    
	
	public function followSomeone()
	{

		parent::getCommonData();

		$this->data['topTraders'] = $this->userService->topTradersDeclineDaysIfNone(7);
		$this->data['latestTraders'] = $this->userService->latestTraders(config('custom.perPage.topTraders'));
		
		return view($this->viewWithPrefix('follow-someone'), $this->data);
		
	}


}