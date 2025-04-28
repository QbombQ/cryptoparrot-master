<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\TradeFeeRepositoryInterface;
use App\Model\Data\Models\TradeFee;

class TradeFeeRepository implements TradeFeeRepositoryInterface
{

    public function create($args)
    {

        $tradeFee = new TradeFee;
        $tradeFee->fill($args);
        $tradeFee->save();

    }

    public function deleteTradeFees($tradeId)
    {

        TradeFee::where('trade_id', $tradeId)->delete();

    }

    public function getTradeFees($tradeId)
    {

        return TradeFee::where('trade_id', $tradeId)->get();

    }

}