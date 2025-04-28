<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface CryptoCurrencyFormatterInterface
{

    public function preparePairSymbolForPaprica($pair);

    public function prepareCryptoCurrencyForDisplay($pair, $result, $papricaSymbol);

}