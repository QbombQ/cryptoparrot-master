<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface CryptoCurrencyServiceInterface
{

    public function getMarkets();
    
    public function updateGraphData();

    public function getGraphData();

    public function getCryptoCurrencyData($acronym);  

}