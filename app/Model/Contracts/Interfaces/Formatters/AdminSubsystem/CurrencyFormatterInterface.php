<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface CurrencyFormatterInterface
{

    public function prepareCurrenciesForDisplay($currencies);

    public function prepareDataForCreation($data);

    public function prepareCurrenciesForTradePairsPage($currencies);

    public function prepareForEdit($currency);

    public function prepareDataForUpdate($data);

}