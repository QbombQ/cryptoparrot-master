<?php

namespace App\Model\Contracts\Interfaces\Validators\Common;

interface TradeConditionValidatorInterface
{

    public function validate($data);

    public function getErrors();

}