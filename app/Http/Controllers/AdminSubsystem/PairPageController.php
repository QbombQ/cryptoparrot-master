<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\TradePairServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\CurrencyServiceInterface;
use Illuminate\Http\Request;

class PairPageController extends BaseAdminSubsystemController
{

    protected $pairService;
    protected $currencyService;

    const REDIRECT_TO_AFTER_ACTION = '/admin/pairs';

    public function __construct(
        TradePairServiceInterface $pairService,
        CurrencyServiceInterface $currencyService
    )
    {

        parent::__construct('pairs');
        $this->pairService = $pairService;
        $this->currencyService = $currencyService;

    }
	
	public function main()
	{

        $this->data['currencies'] = $this->currencyService->getCurrenciesForTradePairs();

		return view($this->viewWithPrefix('new'), $this->data);
		
    }

    public function edit($pairId)
    {

        $this->data['pair'] = $this->pairService->getForEdit($pairId);

        return view($this->viewWithPrefix('edit'), $this->data);	

    }
    
    public function create(Request $request)
    {

        $response = $this->pairService->create($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }

    public function update(Request $request)
    {

        $response = $this->pairService->update($request->all());
        
		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }    

}