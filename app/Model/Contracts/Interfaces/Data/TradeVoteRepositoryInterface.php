<?php

namespace App\Model\Contracts\Interfaces\Data;

interface TradeVoteRepositoryInterface
{

    public function vote($userId, $tradeId);

    public function delete($userId, $tradeId);

    public function voted($userId, $tradeId);

}