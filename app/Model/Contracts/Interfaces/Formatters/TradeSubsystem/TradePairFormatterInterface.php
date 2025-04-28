<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface TradePairFormatterInterface
{

    public function prepareForFeedPage($pairs);

}