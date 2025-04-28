<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\ExchangeServiceInterface;

class ExchangesPageController extends BaseAdminSubsystemController
{

    protected $exchangeService;

    public function __construct(
        ExchangeServiceInterface $exchangeService
    )
    {

        parent::__construct('exchanges');
        $this->exchangeService = $exchangeService;

    }
	
	public function main()
	{
        
        $this->data['exchanges'] = $this->exchangeService->paginate(config('custom.admin.itemsPerPage'));
        
		return view($this->viewWithPrefix('exchanges'), $this->data);		
		
	}

}