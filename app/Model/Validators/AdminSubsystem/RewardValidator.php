<?php

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\RewardValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RewardValidator implements RewardValidatorInterface
{

    protected $validator;
	
	public function validateCreate($data)
	{
        
		$this->validator = Validator::make($data, [
            'title' => 'required|string|unique:rewards,title',
            'image' => 'sometimes|nullable|file|mimetypes:image/jpeg,image/png|max:5000',
            'quantity' => 'sometimes|nullable|integer',
            'price' => 'required|numeric',
            'url' => 'sometimes|nullable|url',
            'sponsor' => 'sometimes|nullable|integer|exists:sponsors,id',
            'description' => 'sometimes|nullable|string'
        ]);		

		return !$this->validator->fails();
		
    }

    public function validateStatusChange($data)
    {

		$this->validator = Validator::make($data, [
            'reward_id' => 'required|exists:user_rewards,id',
            'status' => 'required|in:completed,cancelled,processing'
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
            'url' => 'sometimes|nullable|url',
            'sponsor' => 'sometimes|nullable|integer|exists:sponsors,id',
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