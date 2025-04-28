<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\ArticleServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CompetitionServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CurrencyServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\InvitedUserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradePairServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\HistoricalServiceInterface;
use Auth;
use Feed;

class MainPageController extends BaseTradeSubsystemController
{

	protected $tradeService;
	protected $articleService;
	protected $userService;
	protected $tradePairService;
	protected $currencyService;
	protected $competitionService;
	protected $balanceService;
	protected $invitedUserService;
	protected $historicalService;

	public function __construct(UserFormatterInterface $userFormatter,
								TradeServiceInterface $tradeService,
								ArticleServiceInterface $articleService,
								UserServiceInterface $userService,
								TradePairServiceInterface $tradePairService,
								CurrencyServiceInterface $currencyService,
								CompetitionServiceInterface $competitionService,
								BalanceServiceInterface $balanceService,
								HistoricalServiceInterface $historicalService,
								InvitedUserServiceInterface $invitedUserService) 
	{

		parent::__construct($userFormatter);
		$this->tradeService = $tradeService;
		$this->articleService = $articleService;
		$this->userService = $userService;
		$this->tradePairService = $tradePairService;
		$this->currencyService = $currencyService;
		$this->competitionService = $competitionService;
		$this->balanceService = $balanceService;
		$this->invitedUserService = $invitedUserService;
		$this->historicalService = $historicalService;
		
	}    
	
	public function main()
	{

		parent::getCommonData(); 

		session()->forget('feed_timestamp');
		$this->userService->updateUserActivity(Auth::user());
		$this->invitedUserService->followIfInvited();
		$this->balanceService->updateUsdValues(Auth::user()->handle);

		$this->data['myFeedOn'] = session('my_feed');
		$this->data['currentPair'] = $this->currencyService->getCurrentPair();
		$this->data['currencies'] = $this->currencyService->getCurrencyPairs();
		$this->data['competitions'] = $this->competitionService->getActiveCompetitionsNot(Auth::user()->id, Auth::user()->current_portfolio_id);
		
		$this->data['activeTrades'] = $this->tradeService->getActiveTrades(Auth::user()->current_portfolio_id,'');
		$this->data['activeBuyTrades'] = $this->tradeService->getActiveTrades(Auth::user()->current_portfolio_id,'buy');
		$this->data['activeSellTrades'] = $this->tradeService->getActiveTrades(Auth::user()->current_portfolio_id,'sell');
		$this->data['activeLongTrades'] = $this->tradeService->getActiveTrades(Auth::user()->current_portfolio_id,'long');
		$this->data['activeShortTrades'] = $this->tradeService->getActiveTrades(Auth::user()->current_portfolio_id,'short');

		$this->data['articles'] = $this->articleService->paginate(config('custom.perPage.articles'));
		$this->data['tradePairs'] = $this->tradePairService->getForFeedPage();
		$this->data['weekAnalysis'] = $this->historicalService->getUserWeekAnalysis(Auth::user());
		
		return view($this->viewWithPrefix('feed'), $this->data);
		
	}

	public function redirectFromTrade()
	{

		return redirect('/app', 301);

	}

}
