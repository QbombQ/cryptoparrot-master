<?php 

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Services\Common\TokenServiceInterface;
use App\Model\Contracts\Interfaces\Data\SignUpConfirmationRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\PasswordRecoveryConfirmationRepositoryInterface;

class TokenService implements TokenServiceInterface
{

	protected $signUpConfirmationRepository;
	protected $passwordRecoveryConfirmationRepository;

	public function __construct(SignUpConfirmationRepositoryInterface $signUpConfirmationRepository,
								PasswordRecoveryConfirmationRepositoryInterface $passwordRecoveryConfirmationRepository) 
	{

		$this->signUpConfirmationRepository = $signUpConfirmationRepository;
		$this->passwordRecoveryConfirmationRepository = $passwordRecoveryConfirmationRepository;
		
	}	

    public function generateUserRegistrationToken($user)
    {

		$token = base64_encode($user->email).base64_encode($user->username).time();
		$this->signUpConfirmationRepository->createToken($user->id, $token);
				
		return $token;        

	}
	
    public function generatePasswordRecoverToken($user)
    {

		$token = base64_encode($user->email).base64_encode($user->username).time();
		$this->passwordRecoveryConfirmationRepository->createToken($user->id, $token);
				
		return $token;        

    }	
	
}