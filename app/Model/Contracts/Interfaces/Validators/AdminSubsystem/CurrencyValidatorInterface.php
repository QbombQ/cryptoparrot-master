<?php

namespace App\Model\Contracts\Interfaces\Validators\AdminSubsystem;

interface CurrencyValidatorInterface
{

    public function validateCreate($data);

    public function validateUpdate($data);

}