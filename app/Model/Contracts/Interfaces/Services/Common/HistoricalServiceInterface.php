<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface HistoricalServiceInterface
{

    public function getUserPortfolioHistoricalData($userId);

    public function updateHistoricalPortfolioValues();

    public function getUserPortfolioValueChanges($userId);

    public function archiveHistoricalPortfolioValues($userId);

}