<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use Auth;
use Illuminate\Http\Request;

class TradePageController extends BaseTradeSubsystemController
{

	protected $tradeService;
	protected $balanceService;

	public function __construct(UserFormatterInterface $userFormatter,
								TradeServiceInterface $tradeService,
								BalanceServiceInterface $balanceService)
	{

        parent::__construct($userFormatter);
		$this->tradeService = $tradeService;
		$this->balanceService = $balanceService; 
		
	}

	public function myTrades()
	{

		parent::getCommonData();
		$this->data['myTrades'] = $this->tradeService->getMyTrades(Auth::user()->current_portfolio_id);
		
		return view($this->viewWithPrefix('my-trades'), $this->data);
		
	}  

	public function placeTrade(Request $request)
	{

		parent::getCommonData();
		
		$request->merge([
			'portfolio_id' => Auth::user()->current_portfolio_id
		]);

		if(!$request->price && $request->market && $request->market == 'on') 
		{
			
			$request->merge(['price' => 1]); 

		}

		$response = $this->tradeService->createTrade($request);
		$this->balanceService->updateUsdValues(Auth::user()->handle);

		return $response;
		
	}	

	public function limitExceeded(Request $request)
	{

		return $this->tradeService->limitExceeded($request->all());

	}

	public function updateTrade(Request $request, $id)
	{

        $request->merge([
            'trade_id' => $id,
            'user_id' => Auth::id()
		]);
		
		return $this->tradeService->update(Auth::user(), $request->all());

	}

	public function cancelTrade($id)
	{

		$response = $this->tradeService->cancelTrade($id);
		$this->balanceService->updateUsdValues(Auth::user()->handle);
		
		return json_encode(['success' => true]);

	}

	public function closeTrade($id)
	{

		$response = $this->tradeService->closeTrade($id);

		if($response == trans('TradeSubsystem/error-messages.exceeded-daily-limit'))
		{

			$data['success'] = false;
			$data['message'] = $response;

		}elseif($response == 'SUCCESS'){

			$data['success'] = true;
			$this->balanceService->updateUsdValues(Auth::user()->handle);

		}else{

			$data['success'] = false;
			$data['message'] = 'ERROR';

		}

		return json_encode($data);

	}	

	public function loadTrade($tradeId)
	{

		parent::getCommonData();
		return $this->tradeService->loadTrade($tradeId, Auth::user(),$this->data['commonUserData']);

	}

}