<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\CurrencyServiceInterface;
use Illuminate\Http\Request;

class CurrencyPageController extends BaseAdminSubsystemController
{

    protected $currencyService;

    const REDIRECT_TO_AFTER_ACTION = '/admin/currencies';

    public function __construct(
        CurrencyServiceInterface $currencyService
    )
    {

        parent::__construct('currencies');
        $this->currencyService = $currencyService;

    }
	
	public function main()
	{

        $this->data['cryptoCurrenciesLinkTypes'] = config('custom.crypto_currencies_link_types');

		return view($this->viewWithPrefix('new'), $this->data);		
		
    }

	public function edit($currencyId)
	{

        $this->data['cryptoCurrenciesLinkTypes'] = config('custom.crypto_currencies_link_types');
        $this->data['currency'] = $this->currencyService->getForEdit($currencyId);

        return view($this->viewWithPrefix('edit'), $this->data);
		
    }      
    
    public function create(Request $request)
    {

        $response = $this->currencyService->create($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }

    public function update(Request $request)
    {

        $response = $this->currencyService->update($request->all());
        
		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }    

}