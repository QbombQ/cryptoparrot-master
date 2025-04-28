<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\PasswordRecoveryConfirmationRepositoryInterface;
use App\Model\Data\Models\PasswordRecoveryConfirmation;

class PasswordRecoveryConfirmationRepository implements PasswordRecoveryConfirmationRepositoryInterface
{

	/**
	 * Creates new user registration confirmation token
	 * @param mixed args
	 */
	public function createToken($userId, $token)
	{

		$passwordRecoveryConfirmation = new PasswordRecoveryConfirmation;
        $passwordRecoveryConfirmation->user_id = $userId;
        $passwordRecoveryConfirmation->token = $token;
		$passwordRecoveryConfirmation->save();
		
		return $passwordRecoveryConfirmation->id;
		
	}

	/**
	 * Gets confirmation record based on given token
	 * @param String $token
	 * @return mixed
	 */
	public function get($token)
	{
		
		$confirmation = PasswordRecoveryConfirmation::where('token', $token)->first();
		
		return $confirmation ? $confirmation : null;
		
	}	

	/**
	 * Deletes confirmation record based on given token
	 * @param String $token
	 * @return mixed
	 */
	public function delete($token)
	{
		
		$confirmation = PasswordRecoveryConfirmation::where('token', $token)->first();
		
		if($confirmation) $confirmation->delete();
		
	}		

}