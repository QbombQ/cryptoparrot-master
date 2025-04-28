<?php

namespace App\Model\Contracts\Interfaces\Validators\AdminSubsystem;

interface RewardValidatorInterface
{

    public function validateCreate($data);

    public function validateUpdate($data);

    public function validateStatusChange($data);

}