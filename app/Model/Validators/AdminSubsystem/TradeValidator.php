<?php

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\TradeValidatorInterface;
use Illuminate\Support\Facades\Validator;

class TradeValidator implements TradeValidatorInterface
{

    protected $validator;

    public function validateUpdate($data)
    {

		$this->validator = Validator::make($data, [
            'public' => 'required|in:on,off',
            'follow' => 'required|in:on,off',
            'description' => 'required_if:public,on|sometimes|nullable|string|max:10000',
            'source_type' => 'sometimes|nullable|in:link,image,trading_view,video',
            'analysis' => 'required_if:source_type,image|nullable|file|mimetypes:image/jpeg,image/png|max:4096'
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