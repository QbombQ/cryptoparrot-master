<?php

namespace App\Model\Contracts\Interfaces\Validators\Common;

interface EmailValidatorInterface
{

    public function validateContactsPageForm($data);

    public function getErrors();

}