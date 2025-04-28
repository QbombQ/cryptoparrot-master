<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\CompetitionPrizeFormatterInterface;

class CompetitionPrizeFormatter implements CompetitionPrizeFormatterInterface
{

    public function prepareDataForCreate($args)
    {

        return [
            'competition_id' => $args['competition_id'],
            'place' => $args['place'],
            'title' => $args['title']
        ];

    }

    public function preparePrizesForEdit($prizes)
    {

        $response = [
            'prize_places' => [],
            'prize_titles' => []
        ];

        if($prizes->count() > 0)
        {

            foreach($prizes as $prize)
            {

                $response['prize_places'][] = $prize->place;
                $response['prize_titles'][] = $prize->title;
                
            }

        }

        return $response;

    }

}