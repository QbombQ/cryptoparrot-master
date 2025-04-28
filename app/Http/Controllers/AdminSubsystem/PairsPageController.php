<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\TradePairServiceInterface;

class PairsPageController extends BaseAdminSubsystemController
{

    protected $pairService;

    public function __construct(
        TradePairServiceInterface $pairService
    )
    {

        parent::__construct('pairs');
        $this->pairService = $pairService;

    }
	
	public function main()
	{
        
        $this->data['pairs'] = $this->pairService->paginate(config('custom.admin.itemsPerPage'));
        
		return view($this->viewWithPrefix('pairs'), $this->data);		
		
	}

}