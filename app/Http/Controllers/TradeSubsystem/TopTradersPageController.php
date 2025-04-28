<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;
use Carbon\Carbon;

class TopTradersPageController extends BaseTradeSubsystemController
{

    protected $userService;

    public function __construct(UserFormatterInterface $userFormatter,
                                UserServiceInterface $userService) 
	{

        parent::__construct($userFormatter);
        $this->userService = $userService;
		
	}    

	public function main()
	{

		parent::getCommonData();

		$this->data['top7DaysTraders'] = $this->userService->topTradersDeclineDaysIfNone(7);
		$this->data['top30DaysTraders'] = $this->userService->topTradersDeclineDaysIfNone(30);
		$this->data['topLifeTimeTraders'] = $this->userService->topTraders(config('custom.perPage.topTraders'), 'lifetime');
		
		return view($this->viewWithPrefix('top-traders'), $this->data);
		
	} 

	public function lifetime()
	{

		return $this->userService->topTradersAjax(config('custom.perPage.topTraders'), 'lifetime');

	}

	public function days7()
	{

		return $this->userService->topTradersAjax(config('custom.perPage.topTraders'), Carbon::now()->subDays(15)->toDateString());

	}
	
	public function days30()
	{

		return $this->userService->topTradersAjax(config('custom.perPage.topTraders'), Carbon::now()->subDays(60)->toDateString());

	}	

}