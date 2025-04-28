<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserServiceInterface;
use Illuminate\Http\Request;

class UserPageController extends BaseAdminSubsystemController
{

    protected $userService;

    const REDIRECT_TO_AFTER_ACTION = '/admin/users';

    public function __construct(
        UserServiceInterface $userService
    )
    {

        parent::__construct('users');
        $this->userService = $userService;

    }
    
	public function edit(Request $request)
	{
        
        $response = $this->userService->edit($request->all());
        
		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);
		
	}

}