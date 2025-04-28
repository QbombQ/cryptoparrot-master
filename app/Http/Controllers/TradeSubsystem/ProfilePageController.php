<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\HistoricalServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\FollowServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradePairServiceInterface;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;

use Auth;
use Illuminate\Http\Request;

class ProfilePageController extends BaseTradeSubsystemController
{

	protected $userService;
	protected $followService;
	protected $balanceService;
	protected $tradeService;
	protected $tradePairService;
	protected $userRepository;
	protected $historicalService; 

	public function __construct(UserFormatterInterface $userFormatter,
								FollowServiceInterface $followService,
								TradeServiceInterface $tradeService,
								TradePairServiceInterface $tradePairService,
								HistoricalServiceInterface $historicalService,
								BalanceServiceInterface $balanceService,
								UserRepositoryInterface $userRepository,
                                UserServiceInterface $userService) 
	{

        parent::__construct($userFormatter);
		$this->userService = $userService; 
		$this->userRepository = $userRepository; 
		$this->historicalService = $historicalService; 
		$this->tradePairService = $tradePairService; 
		$this->followService = $followService;
		$this->balanceService = $balanceService;
		$this->tradeService = $tradeService;
		
	}

	public function main($handle = null)
	{

		parent::getCommonData();
		session()->forget('feed_timestamp');
		$this->data['timestamp'] = time();
		session(['profile_timestamp' => $this->data['timestamp']]);
		$this->doCommonProfileJobs($handle);

		if($handle && $handle !== $this->data['profileData']['handle']) 
		{

			$this->data['canonicalUrl'] = url('/'.$this->data['profileData']['handle']);

		}
 
		$this->data['tab'] = 'trades';

		//dd($this->data);  

		return (!$this->data['profileData']) ?
					redirect('/') :
					view($this->viewWithPrefix('profile'), $this->data);
		
	}

	public function load($handle)
	{

		parent::getCommonData();

		$timestamp = session('profile_timestamp');

		if(!$timestamp)
		{

			$timestamp = time();
			session(['profile_timestamp' => $timestamp]);

		}		

		$this->data['timestamp'] = $timestamp;
		$this->doCommonProfileJobs($handle);

		if($this->data['profileData']) 
		{
			
			$this->data['profileTrades'] = $this->userService->getUserTrades(10, $handle ? $handle : Auth::user()->handle, $timestamp);

		}

		if($handle && $handle !== $this->data['profileData']['handle']) 
		{

			$this->data['canonicalUrl'] = url('/'.$this->data['profileData']['handle']);

		}		

		$this->data['tab'] = 'trades';

		return (!$this->data['profileData']) ?
					redirect('/') :
					view($this->viewWithPrefix('profile'), $this->data);
		
	}	

	public function followers($handle = null)
	{

		parent::getCommonData();
		$this->doCommonProfileJobs($handle);

		if($this->data['profileData']) 
		{
			
			$this->data['profileFollowers'] = $this->followService->getUserFollowers($this->data['profileData']['userId']);

		}

		if($handle && $handle !== $this->data['profileData']['handle']) 
		{

			$this->data['canonicalUrl'] = url('/'.$this->data['profileData']['handle'].'/followers');

		}	

		$this->data['tab'] = 'followers';

		return (!$this->data['profileData']) ?
					redirect('/') :
					view($this->viewWithPrefix('profile'), $this->data);
		
	}	

	public function followings($handle = null)
	{

		parent::getCommonData();
		$this->doCommonProfileJobs($handle);

		if($this->data['profileData']) 
		{
			
			$this->data['profileFollowings'] = $this->followService->getUserFollowings($this->data['profileData']['userId']);

		}

		$this->data['tab'] = 'followings';
		
		if($handle && $handle !== $this->data['profileData']['handle']) 
		{

			$this->data['canonicalUrl'] = url('/'.$this->data['profileData']['handle'].'/followings');

		}

		return (!$this->data['profileData']) ?
					redirect('/') :
					view($this->viewWithPrefix('profile'), $this->data);
		
	}	

	public function trade($handle = null, $tradeId)
	{
 
		parent::getCommonData();
		$timestamp = session('profile_timestamp');

		if(!$timestamp) 
		{

			$timestamp = time();
			session(['profile_timestamp' => $timestamp]);

		}		

		$this->data['timestamp'] = $timestamp;
		$this->doCommonProfileJobs($handle);

		if($this->data['profileData']) 
		{

			$this->data['profileTrades'] = $this->userService->getUserTrades(1, $handle ? $handle : Auth::user()->handle);
			$this->data['profileData']['trade'] = $this->tradeService->getUserTrade($this->data['profileData']['userId'], $tradeId);

		}

		$this->data['tab'] = 'trade'; 

		if($handle && $handle !== $this->data['profileData']['handle']) 
		{

			$this->data['canonicalUrl'] = url('/'.$this->data['profileData']['handle'].'/trade/'.$tradeId);

		}

		return (!$this->data['profileData']) ?
					redirect('/') :
					view($this->viewWithPrefix('profile'), $this->data);
		
	}		
	
	private function doCommonProfileJobs($handle)
	{

		$this->balanceService->updateUsdValues($handle ? $handle : Auth::user()->handle);


		$this->data['tradePairs'] = $this->tradePairService->getForFeedPage();
		$this->data['profileData'] = $this->userService->getUserProfile($handle ? $handle : Auth::user()->handle);

		$user = $this->userRepository->get($this->data['profileData']['userId']);
		$this->data['weekAnalysis'] = $this->historicalService->getUserWeekAnalysis($user);
		$this->data['activeTrades'] = $this->tradeService->getActiveTrades($user->current_portfolio_id,'');

	}

}