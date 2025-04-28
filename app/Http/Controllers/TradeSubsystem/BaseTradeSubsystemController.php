<?php

namespace App\Http\Controllers\TradeSubsystem;

use App;
use App\Http\Controllers\Controller;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\BalanceFormatterInterface;
use Auth;
use Number;

class BaseTradeSubsystemController extends Controller
{
	
	protected $data;
	protected $userFormatter;
	protected $subsystemViewPrefix;
	protected $balanceFormatter;
	
	const SUBSYSTEM_VIEW_PREFIX = 'pages/TradeSubsystem/';
	
	public function __construct(
		UserFormatterInterface $userFormatter,
		$viewPrefix = ''
	) 
	{

		App::setLocale('en');
		$this->data = [];
		$this->userFormatter = $userFormatter;
		$this->subsystemViewPrefix = self::SUBSYSTEM_VIEW_PREFIX . $viewPrefix . '/';
		$this->balanceFormatter = App::make(BalanceFormatterInterface::class);
		
	}

	public function getCommonData()
	{

		$rewardService = App::make('App\Model\Contracts\Interfaces\Services\TradeSubsystem\RewardServiceInterface');

		if(Auth::check()) 
		{
			
			$this->data['commonUserData'] = $this->userFormatter->prepareCommonUserDataForTradeSubsystem(Auth::user());
			$this->data['amountLeftNoFormat'] = Auth::check() ? floatval($rewardService->amountLeft(Auth::user())) : 0;
			$this->data['amountLeft'] = Auth::check() ? Number::niceNumber($this->data['amountLeftNoFormat']) : 0;
			$this->data['eligibleAmountLeftNoFormat'] = Auth::check() ? floatval($rewardService->eligibleAmount(Auth::user())) : 0;
			$this->data['eligibleAmountLeft'] = Auth::check() ? Number::niceNumber($this->data['eligibleAmountLeftNoFormat']) : 0;
			$this->data['userBalances'] = $this->balanceFormatter->prepareUserBalancesForPortfolioDisplay(Auth::user()->currentPortfolio->balances->sortBy('id'));
			$redeemUpTo = floatval($this->data['amountLeftNoFormat']) / 1000 * config('custom.satoshi_reward_per_thousand_play_dollars') / 100000000;
			$this->data['redeemUpTo'] = $redeemUpTo == 0 ? 0.00 : sprintf('%f', $redeemUpTo);
		
		}else{ 

			$this->data['eligibleAmountLeft'] = 0;

		}

		$this->data['location'] = geoip(request()->ip());

	}

	public function viewWithPrefix($view)
	{

		return $this->subsystemViewPrefix . $view;

	}

}