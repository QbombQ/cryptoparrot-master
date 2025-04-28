<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface TradeFormatterInterface
{

    public function prepareForDisplay($trades);

    public function prepareForEdit($trade);

    public function prepareDataForUpdate($data);

    public function prepareTradeForSitemap($trade);

}