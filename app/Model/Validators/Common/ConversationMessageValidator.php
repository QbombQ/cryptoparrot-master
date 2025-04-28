<?php

namespace App\Model\Validators\Common;

use App\Model\Contracts\Interfaces\Validators\Common\ConversationMessageValidatorInterface;
use Illuminate\Support\Facades\Validator;

class ConversationMessageValidator implements ConversationMessageValidatorInterface
{

    protected $validator;

    public function validateCreate($data)
    {
        
        $this->validator = Validator::make($data, [
            'message' => 'required|string|max:50000',
            'conversation_id' => 'required|exists:conversations,id',
            'type' => 'required|in:initiator,recipient'
        ]);		

        return !$this->validator->fails();
        
    }  

    public function getErrors()
    {
        
        if(!$this->validator) return null;
        
        return $this->validator;

    }    

}