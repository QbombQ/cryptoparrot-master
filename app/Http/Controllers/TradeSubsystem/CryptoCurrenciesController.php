<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CryptoCurrencyServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;


class CryptoCurrenciesController extends BaseTradeSubsystemController
{

	protected $cryptoCurrencyService; 
	protected $tradeService; 

	public function __construct(
		UserFormatterInterface $userFormatter,
		CryptoCurrencyServiceInterface $cryptoCurrencyService,
		TradeServiceInterface $tradeService
	) 
	{

		parent::__construct($userFormatter);
		$this->cryptoCurrencyService = $cryptoCurrencyService;
		$this->tradeService = $tradeService;
		
	}    
	
	public function main()
	{

		parent::getCommonData(); 

		if(env('APP_FORK') == 'fxparrot') $this->data['currencies'] = $this->cryptoCurrencyService->getMarkets(); 
		else $this->data['currencies'] = $this->cryptoCurrencyService->getGraphData(); 

		return view($this->viewWithPrefix('cryptocurrencies'), $this->data);
		
	}  

	public function single($acronym)
	{ 

		parent::getCommonData(); 

		if(env('APP_FORK') == 'fxparrot'){

		 $this->data['currencyData']['currencyData'] = $this->cryptoCurrencyService->getCryptoCurrencyData($acronym);
		 $this->data['otherCurrencies'] = array();
		
		}else{

		 $this->data['currencyData'] = $this->cryptoCurrencyService->getCryptoCurrencyData($acronym);
		 $this->data['otherCurrencies'] = $this->cryptoCurrencyService->getGraphData();  

		}

		$this->data['newestLongDescriptionTrades'] = $this->tradeService->getTradesWithDescriptionLongerThan(
			config('custom.cryptocurrency_page_trade_description_min_length'),
			$this->data['currencyData']['currencyData']['id']
		);

		$this->data['tvConfig'] = config('custom.trading_view')[$acronym];
 
		if(env('APP_FORK') == 'fxparrot') return view($this->viewWithPrefix('asset'), $this->data);
		else return view($this->viewWithPrefix('cryptocurrency'), $this->data);
		
	}  	

	public function singleStats($acronym)
	{

		parent::getCommonData(); 
		$this->data['currencyData'] = $this->cryptoCurrencyService->getCryptoCurrencyData($acronym);
		$this->data['otherCurrencies'] = $this->cryptoCurrencyService->getGraphData();  
		$this->data['newestLongDescriptionTrades'] = $this->tradeService->getTradesWithDescriptionLongerThan(
			config('custom.cryptocurrency_page_trade_description_min_length'),
			$this->data['currencyData']['currencyData']['id']
		);
		$this->data['tvConfig'] = config('custom.trading_view')[$acronym];

		return view($this->viewWithPrefix('cryptocurrency-stats'), $this->data);

	}

}
