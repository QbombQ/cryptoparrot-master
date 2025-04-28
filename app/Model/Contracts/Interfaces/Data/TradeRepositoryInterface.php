<?php

namespace App\Model\Contracts\Interfaces\Data;

interface TradeRepositoryInterface
{

    public function getById($id);

    public function create($args);

    public function delete($tradeId);

    public function getUserActiveTrades($userId,$tradeType);

    public function getUserTradesFeed($userId, $followings, $limit, $timestamp, $blackList);

    public function getUserTradesPrivateFeed($userId, $followings, $limit, $timestamp, $blackList);

    public function cancel($id);

    public function finish($id);

    public function liquidate($id);

    public function getActiveTrades($tradePairId);

    public function getOpenedTrades($tradePairId);

    public function getTradesHistory($userId);

    public function voteUp($tradeId);

    public function voteDown($tradeId);

    public function update($tradeId, $args);

    public function getTradesCountSince($criteria, $userId);

    public function getTradesCountBetween($start, $end, $userId);

    public function paginate($limit);

    public function getTradesForAverageProfitLossCount($userId);

    public function getTradesForSitemap();
    
    public function getSameCurrencyTrades($authorId, $pairId);

    public function archiveUserTrades($userId, $portfolioId);

    public function getFinishedOrLiquidatedTrades($userId);

    public function getTodayTradesByPair($userId, $pair, $portfolioId);
    
}
