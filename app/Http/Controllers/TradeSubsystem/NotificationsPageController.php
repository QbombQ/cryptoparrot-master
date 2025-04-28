<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\BalanceFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\FeedServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use Auth;

class NotificationsPageController extends BaseTradeSubsystemController
{

	protected $balanceFormatter;
	protected $tradeService;
    protected $feedService;
	protected $notificationService;

	public function __construct(UserFormatterInterface $userFormatter,
								TradeServiceInterface $tradeService,
                                FeedServiceInterface $feedService,
                                NotificationServiceInterface $notificationService,
								BalanceFormatterInterface $balanceFormatter) 
	{

		parent::__construct($userFormatter);
		$this->balanceFormatter = $balanceFormatter;
		$this->tradeService = $tradeService;
        $this->feedService = $feedService;
        $this->notificationService = $notificationService;
		
	}    
	
	public function main()
	{

		parent::getCommonData();
		$this->data['userBalances'] = $this->balanceFormatter->prepareUserBalancesForPortfolioDisplay(Auth::user()->currentPortfolio->balances->sortBy('id'));
        $this->data['activeTrades'] = $this->tradeService->getActiveTrades(Auth::id(),'');
        $this->data['notifications'] = $this->notificationService->paginate(Auth::id(), config('custom.perPage.notifications'));
		$this->notificationService->markNotificationsAsRead(Auth::id());
		
		return view($this->viewWithPrefix('notifications'), $this->data);
		
	}

	public function mains()
	{

		$this->notificationService->notifyUsersAboutUnreadNotifications();

	}

	public function get()
	{

		return $this->notificationService->paginateAjax(Auth::id(), config('custom.perPage.notificationsBubble'));

	}

}