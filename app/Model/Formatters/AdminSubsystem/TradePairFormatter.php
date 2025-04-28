<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\TradePairFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;

class TradePairFormatter implements TradePairFormatterInterface
{

    public function preparePairForEdit($pair)
    {

        return [
            'id' => $pair->id,
            'buy_volume_limit' => $pair->buy_volume_limit,
            'show_on_currencies_page' => $pair->show_on_currencies_page,
            'disabled' => $pair->disabled,
            'sell_volume_limit' => $pair->sell_volume_limit,
            'from_acronym' => $pair->fromCurrency->acronym,
            'to_acronym' => $pair->toCurrency->acronym,
            'priority' => $pair->priority
        ];

    }

    public function preparePairsForDisplay($pairs)
    {

        $results = [
            'pairs' => [],
            'pagination' => ''
        ];

        if($pairs instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($pairs);

        }        

        if($pairs->count() > 0)
        {

            foreach($pairs as $pair)
            {

                $className = 'App\Model\Currencies\\' . $pair->fromCurrency->acronym;
                $cryptoCurrency = new $className;
                $precision = $cryptoCurrency->getDefaultPrecision();   
                $results['pairs'][] = [
                    'id' => $pair->id,
                    'rate' => number_format($pair->rate, $precision),
                    'rate_sell' => number_format($pair->rate_sell, $precision),
                    'from_acronym' => $pair->fromCurrency->acronym,
                    'to_acronym' => $pair->toCurrency->acronym 
                ];

            }
            
        }

        return $results;  

    }

    public function prepareDataForCreation($data)
    {

        return [
            'from_currency_id' => $data['from_currency_id'],
            'to_currency_id' => $data['to_currency_id'],
            'rate' => $data['rate'],
            'rate_sell' => $data['rate_sell'],
            'disabled' => $data['disabled'] === 'on' ? 1 : 0,
            'show_on_currencies_page' => $data['show_on_currencies_page'] === 'on' ? 1 : 0,
            'priority' => $data['priority']
        ];

    }  

    public function prepareDataForUpdate($data)
    {

        return [
            'buy_volume_limit' => $data['buy_volume_limit'],
            'sell_volume_limit' => $data['sell_volume_limit'],
            'disabled' => $data['disabled'] === 'on' ? 1 : 0,
            'show_on_currencies_page' => $data['show_on_currencies_page'] === 'on' ? 1 : 0,
            'priority' => $data['priority']
        ];

    }  

}