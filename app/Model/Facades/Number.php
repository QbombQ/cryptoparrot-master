<?php

namespace App\Model\Facades;

class Number {

    public static function shortNumberFormat($n)
    {

        if($n < 0) return 0;
        
        if ($n > 0 && $n < 1000)
        {

            $n_format = floor($n);
            $suffix = '';

        } else if ($n >= 1000 && $n < 1000000)
        {

            $n_format = floor($n / 1000);
            $suffix = 'K';

        } else if ($n >= 1000000 && $n < 1000000000)
        {

            $n_format = floor($n / 1000000);
            $suffix = 'M';

        } else if ($n >= 1000000000 && $n < 1000000000000)
        {

            $n_format = floor($n / 1000000000);
            $suffix = 'B';

        } else if ($n >= 1000000000000)
        {

            $n_format = floor($n / 1000000000000);
            $suffix = 'T';

        }
    
        return isset($n_format) && !empty($n_format . $suffix) ? $n_format . $suffix : 0;

    }

    public static function shortNumberFormatLimits($n)
    {

        if($n < 0) return 0;
        
        if ($n > 0 && $n < 10000)
        {

            $n_format = floor($n);
            $suffix = '';

        } else if ($n >= 10000 && $n < 1000000)
        {

            $n_format = floor($n / 1000);
            $suffix = 'K';

        } else if ($n >= 1000000 && $n < 1000000000)
        {

            $n_format = floor($n / 1000000);
            $suffix = 'M';

        } else if ($n >= 1000000000 && $n < 1000000000000)
        {

            $n_format = floor($n / 1000000000);
            $suffix = 'B';

        } else if ($n >= 1000000000000)
        {

            $n_format = floor($n / 1000000000000);
            $suffix = 'T';

        }
    
        return isset($n_format) && !empty($n_format . $suffix) ? $n_format . $suffix : 0;

    }

    public static function niceNumber($number)
    {

        return number_format($number, 0, ".", ",");

    }

    public static function numberFormatPrecision($number, $precision = 2, $separator = '.')
    {

        $number = sprintf('%f', $number);
        $numberParts = explode($separator, $number);
        $response = number_format($numberParts[0], 0, '', ',');

        if(count($numberParts)>1)
        {

            $response .= $separator;
            $response .= substr($numberParts[1], 0, $precision);

        }
        return $response;

    }

    public static function ordinal($number)
    {

        $ends = array('th','st','nd','rd','th','th','th','th','th','th');

        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];

    }

    public static function centsToDollars($cents)
    {

        return number_format(($cents /100), 2, '.', ' ');

    }

    public static function decimal($number, $precision)
    {

        return number_format($number, $precision, '.', ' ');

    }

    public static function numberSign($number)
    {

        if($number > 0)
        {

            return '+';

        }

        if($number < 0)
        {

            return '-';

        }

    }

    public static function addSign($sum)
    {

        $sign = '';

        if($sum > 0)
        {

            $sign = '+';

        }
        
        return $sign . $sum;

    }

}