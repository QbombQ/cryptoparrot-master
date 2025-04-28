<?php

namespace App\Model\Contracts\Interfaces\Validators\Common;

interface ConversationMessageValidatorInterface
{

    public function validateCreate($data);

}