<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface TradeServiceInterface
{

    public function getTrades($page, $user, $userOnly, $timestamp, $myFeed);

    public function getUserTrade($userId, $tradeId);

    public function getUserTrades($userId);
 
    public function createTrade($request);

    public function getActiveTrades($userId,$tradeType);

    public function cancelTrade($tradeId, $kernel);

    public function getSourceMetadata($data);

    public function closeTrade($id, $kernel);

    public function updateTradeVisibility($data);

    public function calculateTradeProfit($trade);

    public function checkIfFirstTradeWithThisCrypto($trade);

    public function getTodayTradesValue($userId, $pair, $portfolioId);

    public function loadTrade($tradeId, $user, $commonUserData);

}