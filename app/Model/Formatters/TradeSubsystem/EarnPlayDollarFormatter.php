<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\EarnPlayDollarFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;

class EarnPlayDollarFormatter implements EarnPlayDollarFormatterInterface
{

    public function prepareEarnPlayDollarsForDisplay($earnPlayDollars)
    {

        $results = [
            'earnPlayDollars' => [],
            'pagination' => ''
        ];

        if($earnPlayDollars instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($earnPlayDollars);

        }        

        if($earnPlayDollars->count() > 0)
        {

            foreach($earnPlayDollars as $earnPlayDollar)
            {

                $results['earnPlayDollars'][] = $this->prepareEarnPlayDollarForDisplay($earnPlayDollar);

            }

        }

        return $results;

    }

    public function prepareEarnPlayDollarForDisplay($earnPlayDollar)
    {

        return [ 
            'id' => $earnPlayDollar->id,
            'title' => $earnPlayDollar->title,
            'quantity' => $earnPlayDollar->quantity,
            'description' => $earnPlayDollar->description,
            'image' => $earnPlayDollar->image,
            'price' => $earnPlayDollar->price
        ];

    }

}