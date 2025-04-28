<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface TradeConditionServiceInterface
{

    public function create($data);

    public function update($data);

    public function get($tradeId);

}