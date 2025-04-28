<?php

namespace App\Http\Controllers\FrontSubsystem;

use App\Http\Controllers\FrontSubsystem\BaseFrontSubsystemController;
use App\Model\Contracts\Interfaces\Services\FrontSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface as CommonUserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegistrationController extends BaseFrontSubsystemController
{

	protected $userService;
	protected $commonUserService;

	public function __construct(UserServiceInterface $userService,
								CommonUserServiceInterface $commonUserService) 
	{

		parent::__construct();
		$this->userService = $userService;
		$this->commonUserService = $commonUserService;
		
	}	

	public function loadSignUpScreen()
	{

		return view($this->viewWithPrefix('signup'));

	}

	public function register(Request $request)
	{

		$referer = request()->headers->get('referer');  
	
		$request->merge(['method' => 'email']);
		session()->put('method', 'email');
		$response = $this->userService->registerWithEmail($request);

		if(Str::contains($referer, ['rewards'])){

		return is_string($response) ? // String means success message
			redirect('/app/welcome') :
			redirect('/signup')->withInput()->withErrors($response);

		}else{
 
		return is_string($response) ? // String means success message
				redirect('/app/welcome') :
				back()->withInput()->withErrors($response);

		}
		
	}
 
	public function registerWithRedirect()
	{

		return redirect('/signup')->with('message', trans('FrontSubsystem/error-messages.account-required-to-search'));
		
	} 
	
	public function reserveHandle(Request $request)
	{
		
		$response = $this->userService->reserveHandle($request);
		
		return !empty($response->handle) ? // String means success message
				redirect('/app/welcome') :
				back()->withInput()->withErrors($response);
		
	}	
    
	public function verify($token)
	{

		return $this->commonUserService->confirm($token) ? 
				redirect('/app')->with('message', trans('FrontSubsystem/success-messages.success-account-confirm')) :
				redirect('/')->with('errorMessage', trans('FrontSubsystem/error-messages.error-account-confirm'));
		
	}  
	    
}