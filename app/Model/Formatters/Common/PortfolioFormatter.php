<?php

namespace App\Model\Formatters\Common;

use App\Model\Contracts\Interfaces\Formatters\Common\PortfolioFormatterInterface;
use Number;
use Auth;

class PortfolioFormatter implements PortfolioFormatterInterface
{

    public function prepareCreationFailResponse($errorMessage)
    {

        return [
            'success' => false,
            'message' => $errorMessage
        ];  

    }

    public function prepareCreationSuccessResponse($message, $id)
    {

        return [
            'success' => true,
            'message' => $message,
            'id' => $id
        ];     

    }

    public function prepareDataForCreation($args)
    {

        return [
            'user_id' => $args['user_id'],
            'title' => $args['title'],
            'start_portfolio_value_in_usd' => config('custom.starting_balance'),
            'portfolio_value_in_usd' => config('custom.starting_balance')
        ];

    }

    public function preparePortfoliosForSelect($portfolios)
    {

        $results = [];
        
        if(!$portfolios->isEmpty())
        {

            foreach($portfolios as $portfolio)
            {

                $results[$portfolio->id] = $portfolio->title . ' ($ ' . Number::shortNumberFormat($portfolio->portfolio_value_in_usd) . ')';

            }

        }

        return $results;

    }

}