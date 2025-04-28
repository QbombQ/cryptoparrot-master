<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface TradeFeeFormatterInterface
{

    public function prepareForCreate($tradeId, $fee, $currencyId);

}