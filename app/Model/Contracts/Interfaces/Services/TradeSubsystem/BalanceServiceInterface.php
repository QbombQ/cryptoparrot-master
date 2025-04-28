<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

use Illuminate\Http\Request;

interface BalanceServiceInterface
{

    public function reserve($userId, $currencyId, $portfolioId, $amount);

    public function release($userId, $currencyId, $portfolioId, $amount);

    public function addAmount($userId, $currencyId, $portfolioId, $amount);

    public function createIfDoesNotExist($userId, $portfolioId, $currencyId);

    public function updateUsdValues($userId);

    public function updateAllUsdValues();

    public function resetBalances($userId);

}