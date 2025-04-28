<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\PortfolioServiceInterface;

class PortfoliosController extends BaseAdminSubsystemController
{

    protected $portfolioService;

    public function __construct(
        PortfolioServiceInterface $portfolioService
    )
    {

        $this->portfolioService = $portfolioService;

    }
    
	public function createMainPortfoliosForAll()
	{
        
        $this->portfolioService->createForAll();
		
	}

}