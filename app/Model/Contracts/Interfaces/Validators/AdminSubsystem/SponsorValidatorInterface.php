<?php

namespace App\Model\Contracts\Interfaces\Validators\AdminSubsystem;

interface SponsorValidatorInterface
{

    public function validateCreate($data);

    public function validateUpdate($data);

}