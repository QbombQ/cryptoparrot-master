<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\InvitedUserServiceInterface;

class InvitedUsersPageController extends BaseAdminSubsystemController
{

    protected $invitedUserService;

    public function __construct(
        InvitedUserServiceInterface $invitedUserService
    )
    {

        parent::__construct('invited-users');
        $this->invitedUserService = $invitedUserService;

    }
	
	public function main()
	{
        
        $this->data['invitedUsers'] = $this->invitedUserService->paginate(config('custom.admin.itemsPerPage'));
        
		return view($this->viewWithPrefix('invited-users'), $this->data);		
		
	}

}