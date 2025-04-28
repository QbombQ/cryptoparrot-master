<?php

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\UserValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserValidator implements UserValidatorInterface
{

    protected $validator;

    public function validateEdit($data)
    {

        if(!array_key_exists('user_id', $data))
        {
            
            
            return false;

        }

        $userId = $data['user_id'];

		$this->validator = Validator::make($data, [
            'user_id' => 'required|integer|exists:users,id',
            'username' => ['required','max:50', Rule::unique('users')->ignore($userId)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'status' => 'required|in:unconfirmed,confirmed,banned'
        ]);

		return !$this->validator->fails();

    }

    public function getErrors()
    {
        
        if(!$this->validator) 
        {
            
            return null;

        }

        return $this->validator;

    }    

}