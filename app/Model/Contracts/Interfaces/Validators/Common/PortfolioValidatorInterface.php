<?php

namespace App\Model\Contracts\Interfaces\Validators\Common;

interface PortfolioValidatorInterface
{

    public function validateCreation($data);

    public function getErrors();

}