<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\TradeConditionRepositoryInterface;
use App\Model\Data\Models\TradeCondition;

class TradeConditionRepository implements TradeConditionRepositoryInterface
{

    public function create($args)
    {

        $tradeCondition = new TradeCondition;
        $tradeCondition->fill($args);
        $tradeCondition->save();

        return $tradeCondition->id;

    }

    public function update($tradeId, $args)
    {

        $tradeCondition = TradeCondition::where('trade_id', $tradeId)->first();
        $tradeCondition->fill($args);
        $tradeCondition->save();
        
        return $tradeCondition->id;

    }

    public function get($tradeId)
    {

        return TradeCondition::where('trade_id', $tradeId)->first();

    }

}