<?php

namespace App\Model\Contracts\Interfaces\Formatters\Common;

interface HistoricalFormatterInterface
{

    public function prepareUserPortfolioHistoryForChartDisplay($values);

    public function prepareUserPortfolioValueChangesForDisplay($user, $values);

    public function prepareDataForCreation($userId, $sum);

}