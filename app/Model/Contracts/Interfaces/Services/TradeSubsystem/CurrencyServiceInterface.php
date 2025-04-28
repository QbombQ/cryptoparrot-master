<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

use Illuminate\Http\Request;

interface CurrencyServiceInterface
{

    public function getCurrencyPairs();

    public function updateCurrenciesRates();

    public function updateCurrenciesRatesAverage();

    public function getById($pairId);

}