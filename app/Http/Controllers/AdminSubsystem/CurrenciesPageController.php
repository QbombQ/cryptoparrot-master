<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\CurrencyServiceInterface;

class CurrenciesPageController extends BaseAdminSubsystemController
{

    protected $currencyService;

    public function __construct(
        CurrencyServiceInterface $currencyService
    )
    {

        parent::__construct('currencies');
        $this->currencyService = $currencyService;

    }
	
	public function main()
	{
        
        $this->data['currencies'] = $this->currencyService->paginate(config('custom.admin.itemsPerPage'));
        
		return view($this->viewWithPrefix('currencies'), $this->data);		
		
	}

}