<?php

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\BadgeValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BadgeValidator implements BadgeValidatorInterface
{

    protected $validator;
	
	public function validateCreate($data)
	{
        
		$this->validator = Validator::make($data, [
            'title' => 'required|string|unique:badges,title',
            'is_branded' => 'required|in:on,off'
        ]);		

		return !$this->validator->fails();
		
    }
    
    public function validateGive($data)
    {

		$this->validator = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'badge_id' => 'required|exists:badges,id'
        ]);		

		return !$this->validator->fails();        

    }
	
	public function validateUpdate($data)
	{

        $badgeId = $data['badge_id'];

        if(!$badgeId)
        {
            
            return false;

        }
        
		$this->validator = Validator::make($data, [
            'title' => [
                'required',
                'string',
                Rule::unique('badges')->ignore($badgeId)    
            ],
            'badge_id' => 'required|integer|exists:badges,id',
            'is_branded' => 'required|in:on,off'
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