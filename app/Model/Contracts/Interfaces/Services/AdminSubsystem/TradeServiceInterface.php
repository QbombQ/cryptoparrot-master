<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface TradeServiceInterface
{

    public function paginate($limit);

    public function edit($data);

    public function getForEdit($tradeId);

    public function generateSitemap();

    public function getLastYearStats();

    public function getFinishedTradesWithReservedSums();

    public function getFinishedTradesWithMoreThanOneRelease();

    public function countAllTrades();


        
}