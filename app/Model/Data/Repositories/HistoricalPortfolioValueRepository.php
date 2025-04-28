<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\HistoricalPortfolioValueRepositoryInterface;
use App\Model\Data\Models\HistoricalPortfolioValue;

class HistoricalPortfolioValueRepository implements HistoricalPortfolioValueRepositoryInterface
{

    public function getUserHistoricalData($userId)
    {

        return HistoricalPortfolioValue::where('user_id', $userId)->orderBy('date', 'desc')->get();

    }

    public function getUserWeekAnalysis($userId)
    {

        return HistoricalPortfolioValue::where('user_id', $userId)->orderBy('id', 'desc')->limit(7)->get()->reverse();

    }

    public function create($args)
    {

        $historicalPortfolioValue = new HistoricalPortfolioValue;
        $historicalPortfolioValue->fill($args);
        $historicalPortfolioValue->save();

    }

    public function exists($userId, $date)
    {

        return HistoricalPortfolioValue::where('user_id', $userId)->where('date', $date)->first();

    }

    public function archive($userId)
    {

        HistoricalPortfolioValue::where('user_id', $userId)->update([
            'archived' => 1
        ]);

    }

}