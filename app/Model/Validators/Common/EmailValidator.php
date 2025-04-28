<?php 

namespace App\Model\Validators\Common;

use App\Model\Contracts\Interfaces\Validators\Common\EmailValidatorInterface;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmailValidator implements EmailValidatorInterface
{

    protected $validator;
	
	public function validateContactsPageForm($data)
	{
		
		$this->validator = Validator::make($data, [
            'fullName' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ], [
            'g-recaptcha-response.captcha' => trans('FrontSubsystem/error-messages.invalid-captcha')
        ]);		

		return !$this->validator->fails();
		
    }

    public function getErrors()
    {
        
        if(!$this->validator) return null;
        
        return $this->validator;

    }
    
}