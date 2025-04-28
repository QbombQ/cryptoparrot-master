<?php

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\CompetitionPrizeValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CompetitionPrizeValidator implements CompetitionPrizeValidatorInterface
{

    protected $validator;

    public function validateCreate($data)
    {

        $this->validator = Validator::make($data, [
            'prize_places' => 'required|array',
            'prize_places.*' => 'sometimes|nullable|numeric',
            'prize_titles' => 'required|array',
            'prize_places.*' => 'sometimes|nullable|string'
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