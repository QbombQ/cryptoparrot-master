<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradePairFormatterInterface;
use Currency;

class TradePairFormatter implements TradePairFormatterInterface
{

    public function prepareForFeedPage($pairs)
    {

        $results = [];

        if($pairs->count() > 0)
        {

            foreach($pairs as $pair)
            {

                $symbol = $pair->fromCurrency->acronym;
                $toSymbol = $pair->toCurrency->acronym;
                $price = $pair->rate;
                $priceSell = $pair->rate_sell;
                $cryptoCurrency = Currency::getClass($symbol);   
                $precision = $cryptoCurrency->precisionIn($toSymbol); 

                if(!$precision) 
                {
                    
                    $precision = 2;

                }

                $pct_class = '';  
                if($pair->change > 0) $pct_class = 'pct-up'; 
                else if($pair->change < 0) $pct_class = 'pct-down';  

                $price = number_format($price, $precision, '.', ',');                
                $priceSell = number_format($priceSell, $precision, '.', ',');                
                $results[] = [
                    'id' => $pair->id,
                    'symbol' => $symbol.$toSymbol,
                    'toSymbol' => $pair->toCurrency->symbol,
                    'name' => $pair->fromCurrency->name,
                    'fromCurrency' => $pair->fromCurrency->acronym,
                    'toCurrency' => $pair->toCurrency->acronym, 
                    'fromCurrencyL' => strtolower($pair->fromCurrency->acronym),
                    'toCurrencyL' => strtolower($pair->toCurrency->acronym), 
                    'card' => strtolower($symbol),
                    'symbolWithSlash' => $symbol.'/'.$toSymbol,
                    'symbolForStock' => $symbol,
                    'symbolWithUnderscore' => $symbol.'_'.$toSymbol,
                    'price' => $price,
                    'priceSell' => $priceSell,
                    'change' => $pair->change,
                    'is_stock' => $pair->is_stock,
                    'change_sell' => $pair->change_sell,
                    'weeklyPctChangeAbsolute' =>  abs($pair->weekly_pct_change),
                    'weeklyPctChange' =>  $pair->weekly_pct_change,
                    'weeklyChanceStatus' => $pair->weekly_pct_change != 0 ? ($pair->weekly_pct_change < 0 ? 'negative' : 'positive') : 'no-change',
                    'direction' => 'stay',
                    'pct_class' => $pct_class
                ];

            }

        }

        return $results;

    }

}