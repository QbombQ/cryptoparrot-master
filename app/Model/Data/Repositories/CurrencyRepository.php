<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\CurrencyRepositoryInterface;
use App\Model\Data\Models\Currency;

class CurrencyRepository implements CurrencyRepositoryInterface
{

    public function getTopTenByMarketCap()
    {

        $currencies = Currency::where('primary_pair', 1)->limit(10)->get(); 
        return $currencies;
    }

    public function updateUsdRate($acronym, $rate)
    {

        $currency = Currency::where('acronym', $acronym)->first();

        if($currency)
        {

            $currency->usd_value = $rate;
            $currency->save();

        }

    }

    public function updateUsdRateAverage($acronym, $rate)
    {

        if($acronym == 'DASH')
        {

            $acronym = 'DSH';

        }

        $currency = Currency::where('acronym', $acronym)->first();

        if($currency)
        {

            $currency->average_usd_value = $rate;
            $currency->save();

        }

    }    

    public function getCryptoCurrencies()
    {

        return Currency::where('crypto', 't')->get();

    }    

    public function paginate($limit)
    {

        return Currency::orderBy('id', 'asc')->paginate($limit);

    }    


    public function create($args)
    {

        $currency = new Currency;
        $currency->fill($args);
        $currency->save();
        
        return $currency->id;

    }    

    public function all()
    {

        return Currency::all();

    }

    public function get($currencyId)
    {

        return Currency::find($currencyId);

    }    

    public function getByAcronym($acronym)
    {

        return Currency::where('acronym', 'ilike', $acronym)->first();

    }

    public function update($currencyId, $data)
    {

        $currency = Currency::findOrFail($currencyId);
        $currency->fill($data);
        $currency->save();

    }

}