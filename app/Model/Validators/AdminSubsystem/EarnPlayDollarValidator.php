<?php

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\EarnPlayDollarValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EarnPlayDollarValidator implements EarnPlayDollarValidatorInterface
{

    protected $validator;
	
	public function validateCreate($data)
	{
        
		$this->validator = Validator::make($data, [
            'title' => 'required|string|unique:earn_play_dollars,title',
            'image' => 'sometimes|nullable|file|mimetypes:image/jpeg,image/png|max:5000',
            'quantity' => 'sometimes|nullable|integer',
            'price' => 'required|numeric',
            'description' => 'sometimes|nullable|string'
        ]);	

		return !$this->validator->fails();
		
    }

    public function validateUpdate($data)
    {

		$this->validator = Validator::make($data, [
            'title' => 'required|string',
            'image' => 'sometimes|nullable|file|mimetypes:image/jpeg,image/png|max:5000',
            'quantity' => 'sometimes|nullable|integer',
            'price' => 'required|numeric',
            'description' => 'sometimes|nullable|string'
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