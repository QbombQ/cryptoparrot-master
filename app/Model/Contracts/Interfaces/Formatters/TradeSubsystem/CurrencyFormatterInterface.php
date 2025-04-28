<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface CurrencyFormatterInterface
{

    public function prepareCurrenciesForTradePage($currencies);

    public function prepareCurrenciesAcronymsForCurlRequest($acronyms);

    public function prepareCurrencyForDisplay($currency);

}