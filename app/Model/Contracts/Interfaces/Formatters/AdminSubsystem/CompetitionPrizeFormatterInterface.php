<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface CompetitionPrizeFormatterInterface
{

    public function prepareDataForCreate($args);

    public function preparePrizesForEdit($prizes);

}