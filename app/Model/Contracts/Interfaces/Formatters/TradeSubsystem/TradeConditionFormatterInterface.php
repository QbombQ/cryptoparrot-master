<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface TradeConditionFormatterInterface
{

    public function prepareForCreate($data);

    public function prepareForDisplay($tradeCondition);

}