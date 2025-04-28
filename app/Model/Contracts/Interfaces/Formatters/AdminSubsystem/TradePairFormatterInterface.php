<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface TradePairFormatterInterface
{

    public function preparePairsForDisplay($pairs);

    public function prepareDataForCreation($pairs);

    public function preparePairForEdit($pair);

    public function prepareDataForUpdate($data);

}