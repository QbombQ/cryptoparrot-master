<?php 

namespace App\Model\Services\FrontSubsystem;

use App\Model\Contracts\Interfaces\Services\FrontSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\FrontSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface as TraderFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\Common\UserValidatorInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface as CommonUserService;
use App\Model\Contracts\Interfaces\Services\Common\TokenServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\PasswordRecoveryConfirmationRepositoryInterface;
use Illuminate\Http\Request;
use Socialite;
use Auth;

class UserService implements UserServiceInterface
{

	protected $commonUserService;
	protected $tokenService;
	protected $emailService;
	protected $userValidator;
	protected $userFormatter;
	protected $userRepository;
	protected $passwordRecoveryConfirmationRepository;
	protected $traderFormatter;

	public function __construct(CommonUserService $commonUserService,
								UserRepositoryInterface $userRepository,
								PasswordRecoveryConfirmationRepositoryInterface $passwordRecoveryConfirmationRepository,
								TraderFormatterInterface $traderFormatter,
								TokenServiceInterface $tokenService,
								EmailServiceInterface $emailService,
								UserValidatorInterface $userValidator,
								UserFormatterInterface $userFormatter) 
	{

		$this->commonUserService = $commonUserService;
		$this->tokenService = $tokenService;
		$this->emailService = $emailService;
		$this->userFormatter = $userFormatter;
		$this->userValidator = $userValidator;
		$this->userRepository = $userRepository;
		$this->passwordRecoveryConfirmationRepository = $passwordRecoveryConfirmationRepository;
		$this->traderFormatter = $traderFormatter;
		
	}	
	
	public function registerWithEmail(Request $request)
	{
		
		$response = $this->commonUserService->create($request->all());

		if(is_int($response))
		{

			$this->commonUserService->loginWithId($response);

			return trans('FrontSubsystem/success-messages.success-registration-email');

		} else {

			return $response;

		}
		
	}

	public function loginWithSocialNetwork($network, $user)
	{

		$existingUser = $this->commonUserService->getBySocialId($user->getId());

		if(!$existingUser)
		{

			if($user->getEmail())
			{

				$existingUserWithEmail = $this->commonUserService->getByEmail($user->getEmail());

				if($existingUserWithEmail)
				{

					return trans('FrontSubsystem/error-messages.user-with-email-exists');

				}

			}

		}



		$idToLogin = !$existingUser ?
						$this->commonUserService->create($this->userFormatter->prepareUserDataForRegistrationSocialNetwork($user, $network)) :
						$existingUser->id;

	
		if(is_int($idToLogin))
		{

			$this->commonUserService->loginWithId($idToLogin);

		} else {

			$existingUser = $this->commonUserService->getBySocialId($user->getId());

			if($existingUser)
			{

				$this->commonUserService->loginWithId($existingUser->id);

			}

		}

		return $idToLogin;
		
	}	

	public function loginWithEmail($request)
	{

		if(isset($request->email))
		{

			$request->merge(['email' => strtolower($request->email)]);

		}

		if(!$this->userValidator->validateLogin($request->all())) 
		{
			
			return $this->userValidator->getErrors();

		}

		if(!Auth::attempt(['email' => strtolower($request->email), 'password' => $request->password]))
		{

			return $this->userValidator->getErrors()->getMessageBag()->add('wrong', trans('FrontSubsystem/error-messages.wrong-logins'));

		}
		
		return $this->userFormatter->subsystemUrlByUserType(Auth::user()->type);
		
	}		

	public function reserveHandle(Request $request)
	{ 
		
		$response = $this->commonUserService->reserve(Auth::id(), $request->all());

		if($response === true)
		{
 
			session()->forget('method');
			return true;

		}

		return $response;
		
	}	

	public function recoverPassword(Request $request)
	{

		if(!$this->userValidator->validateRecover($request->all())) 
		{
			
			return $this->userValidator->getErrors();	

		}
					  
		$user = $this->userRepository->getByEmail($request->email);
		
		if(!$user) 
		{
			
			return [];

		}

		$token = $this->tokenService->generatePasswordRecoverToken($user);
		$url = url('/recover/') . '/'. $token;
		$this->emailService->sendPasswordResetConfirmationEmail($user->email, $url, $user->username);

		return trans('FrontSubsystem/success-messages.password-recovery-success');		

	}

	public function passwordRecoveryTokenValid($token)
	{

		$confirmation = $this->passwordRecoveryConfirmationRepository->get($token);

		if(!$confirmation || !$this->userRepository->get($confirmation->user_id)) 
		{
			
			return false; // token or user does not exist

		}

		return true;

	}

	public function changePassword($request)
	{

		if(!$this->userValidator->validatePasswordChange($request->all())) 
		{
			
			return $this->userValidator->getErrors();	

		}
					  
		$confirmation = $this->passwordRecoveryConfirmationRepository->get($request->token);

		if(!$confirmation) 
		{
			
			return [];

		}

		$this->userRepository->updateUser($confirmation->user_id, $this->traderFormatter->prepareRequestDataForPasswordUpdate(['new_password' => $request->password]));
		$this->passwordRecoveryConfirmationRepository->delete($confirmation->token);

		$this->commonUserService->loginWithId($confirmation->user_id);

		return trans('FrontSubsystem/success-messages.password-recovery-success');

	}	

	public function getCodeCount($code)
	{

		return $this->userRepository->getCodeCount($code);

	}
	
}