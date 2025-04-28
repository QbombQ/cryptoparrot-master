<?php

namespace App\Http\Controllers\FrontSubsystem;

use App\Http\Controllers\FrontSubsystem\BaseFrontSubsystemController;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface;
use Cookie;
use Auth;

class MainPageController extends BaseFrontSubsystemController
{

	protected $userService;

	public function __construct(
		UserServiceInterface $userService
	)
	{

		parent::__construct();
		$this->userService = $userService;

	}
	
	public function main()
	{

		parent::getCommonData();
		$this->data['canonical'] = url('/');

		return view($this->viewWithPrefix('landing'), $this->data);		
		
	}

	public function mobileHome()
	{

		parent::getCommonData();
		
		if(Auth::check())
		{

			return redirect('/app', 302);

		}

		return view($this->viewWithPrefix('landingMobile'), $this->data);		
		
	}


	public function invited($handle)
	{

		$user = $this->userService->getByHandle($handle);

		if($user) 
		{

			Cookie::queue('invited_by', $user->id, config('custom.ref_code_expire_time_in_mins'));

		}

		return redirect('/');

	}

}