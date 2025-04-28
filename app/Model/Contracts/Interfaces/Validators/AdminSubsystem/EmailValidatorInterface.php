<?php

namespace App\Model\Contracts\Interfaces\Validators\AdminSubsystem;

interface EmailValidatorInterface
{

    public function validateMassEmail($data);

}