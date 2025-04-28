<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeFeeFormatterInterface;

class TradeFeeFormatter implements TradeFeeFormatterInterface
{

    public function prepareForCreate($tradeId, $fee, $currencyId)
    {

        return [
            'trade_id' => $tradeId,
            'fee' => $fee,
            'currency_id' => $currencyId
        ];

    }

}