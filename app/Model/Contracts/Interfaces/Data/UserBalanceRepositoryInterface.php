<?php

namespace App\Model\Contracts\Interfaces\Data;

interface UserBalanceRepositoryInterface
{

    public function reserve($userId, $currencyId, $portfolioId, $amount);

    public function release($userId, $currencyId, $portfolioId, $amount);

    public function addAmount($userId, $currencyId, $portfolioId, $amount);

    public function createIfDoesNotExist($userId, $currencyId, $portfolioId);

    public function update($balanceId, $data);

    public function reset($userId, $portfolioId);

}