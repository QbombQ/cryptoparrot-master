<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface TradeFeeServiceInterface
{

    public function create($trade);

    public function deleteTradeFees($tradeId);

}