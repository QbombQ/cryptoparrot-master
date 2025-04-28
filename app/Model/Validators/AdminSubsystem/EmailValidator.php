<?php

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\EmailValidatorInterface;
use Illuminate\Support\Facades\Validator;

class EmailValidator implements EmailValidatorInterface
{

    protected $validator;
	
	public function validateMassEmail($data)
	{
        
		$this->validator = Validator::make($data, [
            'subject' => 'required|string|min:0',
            'content' => 'required|string|min:0',
            'badge' => 'sometimes|nullable',
            'badge.*' => 'sometimes|exists:badges,id',
            'competition' => 'sometimes|nullable',
            'competition.*' => 'sometimes|exists:competitions,id',   
            'users' => 'sometimes|nullable',
            'users.*' => 'sometimes|exists:users,id',                      
            'test_email' => 'sometimes|nullable|email'
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