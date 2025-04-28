<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;
use Auth;
use Illuminate\Http\Request;

class SettingsPageController extends BaseTradeSubsystemController
{

	protected $userService;

	public function __construct(UserFormatterInterface $userFormatter,
                                UserServiceInterface $userService) 
	{

        parent::__construct($userFormatter);
		$this->userService = $userService;
		
	}    

	public function main()
	{

		parent::getCommonData();
		$this->data['settingsData'] = $this->userService->getUserSettings(Auth::id());

		return (!$this->data['settingsData']) ?
					redirect('/') :
					view($this->viewWithPrefix('settings'), $this->data);	
		
	}

	public function updateProfile(Request $request)
	{

		return $this->userService->updateProfile($request);	
		
	}	

	public function updateSocialLinks(Request $request)
	{

		return $this->userService->updateSocialLinks($request);	
		
	}		

	public function updateNotifications(Request $request)
	{

		return $this->userService->updateNotifications($request);	
		
	}	

	public function updatePassword(Request $request)
	{

		return $this->userService->updatePassword($request);	
		
	}	

	public function updateAvatar(Request $request)
	{

		return $this->userService->updateAvatar($request);
		
	}		

	public function updateCover(Request $request)
	{

		return $this->userService->updateCover($request);
		
	}	

	public function uploadTempCover(Request $request)
	{

		return $this->userService->uploadTempCover($request);
		
	}		

}