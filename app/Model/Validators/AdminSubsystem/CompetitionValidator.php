<?php

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\CompetitionValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CompetitionValidator implements CompetitionValidatorInterface
{

    protected $validator;
	
	public function validateCreate($data)
	{
        
		$this->validator = Validator::make($data, [
            'title' => 'required|string|min:1',
            'badge' => 'sometimes|nullable',
            'badge.*' => 'sometimes|nullable|integer|exists:badges,id',
            'start_date' => 'nullable|date',
            'prize' => 'required',
            'end_date' => 'nullable|date|after:start_date',
            'thumbnail' => 'sometimes|file|mimetypes:image/jpeg,image/png|max:500',
            'description' => 'required|string|min:1',
            'is_private' => 'required|in:on,off'
        ]);		

		return !$this->validator->fails();
		
	}
	
	public function validateUpdate($data)
	{
        
		$this->validator = Validator::make($data, [
            'title' => 'required|string|min:1',
            'badge' => 'sometimes|nullable',
            'badge.*' => 'sometimes|nullable|integer|exists:badges,id',
            'start_date' => 'required|date',
            'prize' => 'required',
            'end_date' => 'required|date|after:start_date',
            'thumbnail' => 'sometimes|file|mimetypes:image/jpeg,image/png|max:500',
            'description' => 'required|string|min:1',
            'is_private' => 'required|in:on,off'         
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