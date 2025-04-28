<?php

namespace App\Model\Contracts\Interfaces\Data;

interface TradeFeeRepositoryInterface
{

    public function create($args);

    public function deleteTradeFees($tradeId);

    public function getTradeFees($tradeId);

}