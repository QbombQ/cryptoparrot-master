<?php

namespace App\Model\Validators\Common;

use App\Model\Contracts\Interfaces\Validators\Common\PortfolioValidatorInterface;
use Illuminate\Support\Facades\Validator;

class PortfolioValidator implements PortfolioValidatorInterface
{

    protected $validator;


    public function validateCreation($data)
    {

		$this->validator = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|unique_with:portfolios,user_id'
        ]);		

		return !$this->validator->fails();

    }    
    
    public function getErrors()
    {
        
        if(!$this->validator) return null;
        
        return $this->validator;

    }

}