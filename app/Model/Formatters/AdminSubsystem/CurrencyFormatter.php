<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\CurrencyFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;

class CurrencyFormatter implements CurrencyFormatterInterface
{

    public function prepareCurrenciesForDisplay($currencies)
    {

        $results = [
            'currencies' => [],
            'pagination' => ''
        ];

        if($currencies instanceof LengthAwarePaginator)
        {
            
            $results['pagination'] = Pagination::defaultPagination($currencies);

        }        

        if($currencies->count() > 0)
        {

            foreach($currencies as $currency)
            {

                $results['currencies'][] = [
                    'id' => $currency->id,
                    'name' => $currency->name,
                    'acronym' => $currency->acronym,
                    'symbol' => $currency->symbol,
                    'description' => $currency->description,
                    'usd_value' => $currency->usd_value
                ];

            }

        }

        return $results;        

    }

    public function prepareDataForCreation($data)
    {

        return [
            'name' => $data['name'],
            'acronym' => $data['acronym'],
            'symbol' => $data['symbol'],
            'crypto' => true,
            'description' => $data['description'],
            'usd_value' => $data['usd_value'],
            'full_description' => $data['full_description'],
            'meta_title' => $data['meta_title'],
            'seo_title' => $data['seo_title'],
            'meta_description' => $data['meta_description'],
            'seo_description' => $data['seo_description'],
            'asset_description' => $data['asset_description'],
            'links' => json_encode($data['links'])
        ];

    }

    public function prepareDataForUpdate($data)
    {

        return [
            'name' => $data['name'],
            'acronym' => $data['acronym'],
            'symbol' => $data['symbol'],
            'crypto' => true,
            'description' => $data['description'],
            'full_description' => $data['full_description'],
            'meta_title' => $data['meta_title'],
            'seo_title' => $data['seo_title'],
            'meta_description' => $data['meta_description'],
            'seo_description' => $data['seo_description'],
            'asset_description' => $data['asset_description'],
            'links' => json_encode($data['links'])
        ];

    }    

    public function prepareForEdit($currency)
    {

        return [
            'id' => $currency->id,
            'name' => $currency->name,
            'acronym' => $currency->acronym,
            'symbol' => $currency->symbol,
            'description' => $currency->description,
            'full_description' => $currency->full_description,
            'usd_value' => $currency->usd_value,
            'meta_title' => $currency->meta_title,
            'meta_description' => $currency->meta_description,
            'seo_title' => $currency->seo_title,
            'seo_description' => $currency->seo_description,
            'asset_description' => $currency->asset_description,
            'links' => json_decode($currency->links, true)
        ]; 

    }

    public function prepareCurrenciesForTradePairsPage($currencies)
    {

        $results = [];

        if($currencies->count() > 0)
        {

            foreach($currencies as $currency)
            {

                $results[$currency->id] = $currency->name;
                
            }

        }

        return $results;

    }

}