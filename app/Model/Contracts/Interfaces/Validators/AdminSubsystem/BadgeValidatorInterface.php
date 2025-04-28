<?php

namespace App\Model\Contracts\Interfaces\Validators\AdminSubsystem;

interface BadgeValidatorInterface
{

    public function validateCreate($data);

    public function validateUpdate($data);

    public function validateGive($data);

}