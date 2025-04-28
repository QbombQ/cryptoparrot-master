<?php

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\SponsorValidatorInterface;
use Illuminate\Support\Facades\Validator;

class SponsorValidator implements SponsorValidatorInterface
{

    protected $validator;
	
	public function validateCreate($data)
	{
        
		$this->validator = Validator::make($data, [
            'title' => 'required|string|unique:sponsors,title',
            'url' => 'sometimes|nullable|url',
            'logo' => 'sometimes|nullable|file|mimetypes:image/jpeg,image/png|max:5000'
        ]);		

		return !$this->validator->fails();
		
    }

    public function validateUpdate($data)
    {

		$this->validator = Validator::make($data, [
            'title' => 'required|string',
            'url' => 'sometimes|nullable|url',
            'logo' => 'sometimes|nullable|file|mimetypes:image/jpeg,image/png|max:5000'
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