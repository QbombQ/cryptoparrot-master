<?php

namespace App\Model\Contracts\Interfaces\Validators\Common;

interface TradeValidatorInterface
{

    public function validateCreation($data);

    public function validateSource($data);

    public function getErrors();

}