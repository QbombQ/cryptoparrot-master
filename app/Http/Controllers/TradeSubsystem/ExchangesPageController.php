<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\ExchangeServiceInterface;
use Auth;
use Illuminate\Http\Request;

class ExchangesPageController extends BaseTradeSubsystemController
{

	protected $exchangeService;

	public function __construct(
        UserFormatterInterface $userFormatter,
        ExchangeServiceInterface $exchangeService
    ) 
	{

		parent::__construct($userFormatter);
		$this->exchangeService = $exchangeService;
		
	}

    public function exchange(Request $request)
    {

        return $this->exchangeService->exchange(Auth::user(), $request->all());

    }

    public function exchangeCallback(Request $request)
    {

        $this->exchangeService->exchangeCallback($request);

    }

}