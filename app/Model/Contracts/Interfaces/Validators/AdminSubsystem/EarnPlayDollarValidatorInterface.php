<?php

namespace App\Model\Contracts\Interfaces\Validators\AdminSubsystem;

interface EarnPlayDollarValidatorInterface
{

    public function validateCreate($data);

    public function validateUpdate($data);

}