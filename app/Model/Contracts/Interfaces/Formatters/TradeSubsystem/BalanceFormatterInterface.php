<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface BalanceFormatterInterface
{

    public function prepareUserBalancesForPortfolioDisplay($balances);

    public function calculateBalancesSumInUSDChangeFromStart($balances);

    public function calculateBalancesSumInUSD($balances);

}