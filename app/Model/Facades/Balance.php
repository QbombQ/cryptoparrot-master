<?php

namespace App\Model\Facades;

use App\Model\Data\Models\Currency;
use Number;

class Balance {

    public static function portfolioSign($portfolio)
    {
        
        return ($portfolio->portfolio_value_in_usd - $portfolio->start_portfolio_value_in_usd) > 0 ? '+' : '-';

    }

    public static function portfolioTotalValue($portfolio)
    {

        return Balance::portfolioSign($portfolio).Number::decimal(
            abs(
                $portfolio->portfolio_value_in_usd / $portfolio->start_portfolio_value_in_usd * 100 - 100
            ), 1
        ).'%';

    }

    public static function portfolioTotalBalanceClass($portfolio)
    {

        $portfolioSign = Balance::portfolioSign($portfolio);

        if(strpos($portfolioSign, '+') !== false)
        {

            return 'positive';

        }

        if(strpos($portfolioSign, '-') !== false)
        {

            return 'negative';

        }

        return '';

    }

    public static function increaseClass($difference)
    {

        if($difference > 0) 
        {

            return 'positive';

        }

        if($difference < 0) 
        {

            return 'negative';

        }

        return '';

    }

    public static function dollar()
    {

        return Currency::orderBy('id', 'asc')->first(); 

    }

}