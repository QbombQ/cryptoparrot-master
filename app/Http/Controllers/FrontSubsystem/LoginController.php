<?php

namespace App\Http\Controllers\FrontSubsystem;

use App\Http\Controllers\FrontSubsystem\BaseFrontSubsystemController;
use App\Model\Contracts\Interfaces\Services\FrontSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface as CommonUserServiceInterface;
use Illuminate\Http\Request;
use Socialite;

class LoginController extends BaseFrontSubsystemController
{

	protected $userService;
	protected $commonUserService;

	public function __construct(UserServiceInterface $userService,
								CommonUserServiceInterface $commonUserService) 
	{

		$this->userService = $userService;
		$this->commonUserService = $commonUserService;
		
	}	
	
	public function loginWith($socialNetwork)
	{

		session()->put('method', $socialNetwork);

		return Socialite::driver($socialNetwork)->redirect(); 
		
	}	

    public function finishLoginWithSocialMedia()
    {

		$method = session()->get('method');
		
        try {

			$user = Socialite::driver($method)->user();
			session()->put('nickname', $user->nickname);


			if(!$method || !$user) 
			{
				
				return redirect('/');

			} 

			$response = $this->userService->loginWithSocialNetwork($method, $user);

			return is_int($response) ? 
					redirect('/pick-your-handle') :
					redirect('/login')->with('message', $response);

		}catch (\Exception $e) 
		{

			return redirect ('/login')->with('message', trans('FrontSubsystem/error-messages.something-went-wrong'));
			
        }

	}

    public function loginWithEmail(Request $request)
    {

		$response = $this->userService->loginWithEmail($request);

		return is_string($response) ?
				redirect('/app') :
				back()->withErrors($response);

    }

}