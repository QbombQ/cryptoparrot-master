<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\EarnPlayDollarServiceInterface;

class EarnPlayDollarsPageController extends BaseTradeSubsystemController
{

	protected $earnPlayDollarService;

	public function __construct(
        UserFormatterInterface $userFormatter,
        EarnPlayDollarServiceInterface $earnPlayDollarService
    ) 
	{

		parent::__construct($userFormatter);
		$this->earnPlayDollarService = $earnPlayDollarService;
		
	}
	
    public function main()
    {

        parent::getCommonData();
        $this->data['earnPlayDollars'] = $this->earnPlayDollarService->paginate(config('custom.perPage.rewards'));

        return view($this->viewWithPrefix('earnPlayDollars'), $this->data);

    }

}