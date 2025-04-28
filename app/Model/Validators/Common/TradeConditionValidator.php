<?php

namespace App\Model\Validators\Common;

use App\Model\Contracts\Interfaces\Validators\Common\TradeConditionValidatorInterface;
use Illuminate\Support\Facades\Validator;

class TradeConditionValidator implements TradeConditionValidatorInterface
{

    protected $validator;
  
    public function validate($data)
    {

		$this->validator = Validator::make($data, [
            'trade_id' => 'sometimes|nullable|exists:trades,id',
            'below_limit' => 'sometimes|nullable|numeric|min:0',
            'above_limit' => 'sometimes|nullable|numeric|min:0'
        ]);		

		return !$this->validator->fails();

    }    

    public function getErrors()
    {
        
        if(!$this->validator) return null;
        
        return $this->validator;

    }

}