<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface TradePairServiceInterface
{

    public function getForFeedPage();
    public function getWeeklyChangeForEachPair();

}  