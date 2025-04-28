<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeConditionFormatterInterface;

class TradeConditionFormatter implements TradeConditionFormatterInterface
{

    public function prepareForCreate($data)
    {

        return [
            'below_limit' => array_key_exists('below_limit', $data) ? $data['below_limit'] : null,
            'trade_id' => $data['trade_id'],
            'above_limit' => array_key_exists('above_limit', $data) ? $data['above_limit'] : null
        ];

    }

    public function prepareForDisplay($tradeCondition)
    {

        if(!$tradeCondition) return null;

        return [
            'below_limit' => $tradeCondition->below_limit,
            'above_limit' => $tradeCondition->above_limit
        ];

    }

}