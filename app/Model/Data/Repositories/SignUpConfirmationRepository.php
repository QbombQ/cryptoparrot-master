<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\SignUpConfirmationRepositoryInterface;
use App\Model\Data\Models\SignUpConfirmation;

class SignUpConfirmationRepository implements SignUpConfirmationRepositoryInterface
{

	/**
	 * Creates new user registration confirmation token
	 * @param mixed args
	 */
	public function createToken($userId, $token)
	{

		$confirmation = SignUpConfirmation::where('token', $token)->first();

		if(!$confirmation) {
			$signUpConfirmation = new SignUpConfirmation;
			$signUpConfirmation->user_id = $userId;
			$signUpConfirmation->token = $token;
			$signUpConfirmation->save();
			return $signUpConfirmation->id;
		}
		
		return $confirmation->id;
		
	}

	/**
	 * Gets confirmation record based on given token
	 * @param String $token
	 * @return mixed
	 */
	public function get($token)
	{
		
		$confirmation = SignUpConfirmation::where('token', $token)->first();
		
		return $confirmation ? $confirmation : null;
		
	}	

	/**
	 * Deletes confirmation record based on given token
	 * @param String $token
	 * @return mixed
	 */
	public function delete($token)
	{
		
		$confirmation = SignUpConfirmation::where('token', $token)->first();
		
		if($confirmation) $confirmation->delete();
		
	}	


}