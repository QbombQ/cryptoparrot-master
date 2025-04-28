<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\CompetitionServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserServiceInterface;

class CompetitionsPageController extends BaseAdminSubsystemController
{

    protected $competitionService;
    protected $userService;

    public function __construct(
        CompetitionServiceInterface $competitionService,
        UserServiceInterface $userService
    )
    {

        parent::__construct('competitions');
        $this->competitionService = $competitionService;
        $this->userService = $userService;

    }
	
	public function main()
	{
        
        $this->data['competitions'] = $this->competitionService->paginate(config('custom.admin.itemsPerPage'));
        $this->data['users'] = $this->userService->all();
        
		return view($this->viewWithPrefix('competitions'), $this->data);		
		
    }

}