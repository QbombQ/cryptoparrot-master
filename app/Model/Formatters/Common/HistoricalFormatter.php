<?php

namespace App\Model\Formatters\Common;

use App\Model\Contracts\Interfaces\Formatters\Common\HistoricalFormatterInterface;
use Carbon\Carbon;

class HistoricalFormatter implements HistoricalFormatterInterface
{

    public function prepareUserWeekAnalysis($portfolioValues, $user)
    {

        $weekAnalysis = [];
        $lastDayInDB = now();

        if($portfolioValues->isNotEmpty())
        {

            foreach($portfolioValues as $portfolioValue)
            {

                $change = $portfolioValue->portfolio_usd_value - $user->currentPortfolio->start_portfolio_value_in_usd;
                $lastDayInDB = $portfolioValue->date;

                $changeFormatted = '$'.number_format( $change , 0 , '.' , ',' ); 
                $changeFormatted = str_replace('$-', '-$', $changeFormatted);

                $percentChange = intval(($change / $user->currentPortfolio->start_portfolio_value_in_usd) * 100);

                if($percentChange >= 0){
                    $direction = 'positive';
                    $percentOffset = 50;
                }else{
                    $direction = 'negative';
                    $percentOffset = 50 - abs($percentChange);
                }

                $percentHeight = abs($percentChange);

                $weekAnalysis[] = [
                    'day' => \Carbon\Carbon::parse($portfolioValue->date)->format('l')[0],
                    'change' => $change,
                    'changeFormatted' => $changeFormatted,
                    'percentChange' => $percentChange,
                    'percentOffset' => $percentOffset,
                    'percentHeight' => $percentHeight,
                    'direction' => $direction,
                ]; 



            }

        }

        while(count($weekAnalysis) < 7)
        {

            array_unshift($weekAnalysis, [
                'day' => \Carbon\Carbon::parse($lastDayInDB)->format('l')[0],
                'change' => 0,
                'changeFormatted' => '$0',
                'percentChange' => 0,
                'percentOffset' => 0,
                'percentHeight' => 0,
                'direction' => 0,
            ]); 

            $lastDayInDB = \Carbon\Carbon::parse($lastDayInDB)->subDays(1)->timestamp;

        }

        return $weekAnalysis;

    }

    public function prepareUserPortfolioHistoryForChartDisplay($values)
    {

        $results['30days'] = [];
        $slice30 = $values->slice(0, 30)->toArray();

        for($i = 0; $i < 30; $i++)
        {

            if(array_key_exists($i, $slice30))
            {

                $results['30days'][] = (int)$slice30[$i]['portfolio_usd_value'];

            } else {

                $results['30days'][] = config('custom.starting_balance');

            }

        }

        $results['7days'] = array_slice($results['30days'], 0, 7); 
        $results['30days'] = array_reverse($results['30days']);
        $results['7days'] = array_reverse($results['7days']);

        return $results;

    }

    public function prepareUserPortfolioValueChangesForDisplay($user, $values)
    {

        $results['lifetime'] = $this->getChangeInPercentBetweenValues($user->mainPortfolio->portfolio_value_in_usd, config('custom.starting_balance'));
        $results['7days'] = null;
        $results['30days'] = null;

        return $results;

    }  
    
    private function getChangeInPercentBetweenValues($currentValue, $pastValue)
    {
        
        $currentValueDouble = (double)$currentValue;
        $pastValueDouble = (double)$pastValue;
        $result = $currentValueDouble / $pastValueDouble * 100 - 100;
        
        return $result;

    }

    public function prepareDataForCreation($userId, $sum)
    {

        return [
            'user_id' => $userId,
            'portfolio_usd_value' => $sum,
            'date' => Carbon::now()
        ];

    } 

}