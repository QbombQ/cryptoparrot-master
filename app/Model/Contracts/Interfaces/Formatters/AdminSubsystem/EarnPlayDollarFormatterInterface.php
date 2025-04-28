<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface EarnPlayDollarFormatterInterface
{

    public function prepareEarnPlayDollarsForDisplay($earnPlayDollars);

    public function prepareDataForCreation($data);

    public function prepareDataForUpdate($data);

    public function prepareEarnPlayDollarForEdit($earnPlayDollar);

}