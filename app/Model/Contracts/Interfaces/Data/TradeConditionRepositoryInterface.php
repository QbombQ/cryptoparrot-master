<?php

namespace App\Model\Contracts\Interfaces\Data;

interface TradeConditionRepositoryInterface
{

    public function create($args);

    public function update($tradeId, $args);

}