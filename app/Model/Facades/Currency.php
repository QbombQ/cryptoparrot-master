<?php

namespace App\Model\Facades;

use App\Model\Data\Models\Currency as CurrencyModel;
use Number;

class Currency {

    public static function dollar()
    {

        return CurrencyModel::orderBy('id', 'asc')->first(); 

    }

    public static function getUsdRate($eligibleAmountLeftNoFormat)
    {

        if($eligibleAmountLeftNoFormat < 20001) $perK = 0.05;
        else if($eligibleAmountLeftNoFormat > 20000 && $eligibleAmountLeftNoFormat < 50001) $perK = 0.025;
        else if($eligibleAmountLeftNoFormat > 50000 && $eligibleAmountLeftNoFormat < 100001) $perK = 0.01;
        else $perK = 0.001;

        return $perK; 

    }

    public static function getClass($acronym)
    {

        $className = 'App\Model\Currencies\\' . $acronym;
        return new $className;

    }
 
    public static function getTradeProfit($trade)
    {

        $fee = $trade->tradeFee ? $trade->tradeFee->fee : 0;

        if($fee === 0) 
        {
            
            return $trade->profit;

        }

        

    }

}