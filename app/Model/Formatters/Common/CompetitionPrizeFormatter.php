<?php

namespace App\Model\Formatters\Common;

use App\Model\Contracts\Interfaces\Formatters\Common\CompetitionPrizeFormatterInterface;
use Number;

class CompetitionPrizeFormatter implements CompetitionPrizeFormatterInterface
{

    public function prepareForDisplay($prizes)
    {

        $response = [];

        if($prizes->count() > 0)
        {

            foreach($prizes as $prize)
            {

                $response[] = Number::ordinal($prize->place) . ' Place: ' . $prize->title;

            }
            
        }

        return $response;

    }

}