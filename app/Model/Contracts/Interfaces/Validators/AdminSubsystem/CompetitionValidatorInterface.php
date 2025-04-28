<?php

namespace App\Model\Contracts\Interfaces\Validators\AdminSubsystem;

interface CompetitionValidatorInterface
{

    public function validateCreate($data);

    public function validateUpdate($data);

}