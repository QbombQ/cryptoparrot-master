<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface TradeFormatterInterface
{

    public function prepareSourceMetadataResponse($data);

    public function prepareSourceMetadataResponseWithErrors($errors);

    public function prepareRequestForTradeCreation($data);

    public function prepareActiveTradesForDisplay($trades);

    public function prepareTradesForFeedPage($trades, $viewer);

    public function prepareActiveTradesForTableDisplay($trades);

    public function prepareTradeFinishedTextForNotification($trade);

    public function prepareTradeLiquidatedTextForNotification($trade);

    public function prepareDataForVisibilityUpdate($data);

}