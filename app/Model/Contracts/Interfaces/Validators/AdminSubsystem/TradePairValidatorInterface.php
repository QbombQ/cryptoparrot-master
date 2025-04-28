<?php

namespace App\Model\Contracts\Interfaces\Validators\AdminSubsystem;

interface TradePairValidatorInterface
{

    public function validateCreate($data);

    public function validateUpdate($data);

}