<?php

namespace App\Model\Contracts\Interfaces\Data;

interface HistoricalPortfolioValueRepositoryInterface
{

    public function getUserHistoricalData($userId);

    public function create($args);

    public function exists($userId, $date);

    public function archive($userId);

}