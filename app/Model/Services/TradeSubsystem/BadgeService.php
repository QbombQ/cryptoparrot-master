<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BadgeServiceInterface;

class BadgeService implements BadgeServiceInterface
{

    public function userHasBadges($user, $badges)
    {

        $result = true;

        if($badges->count() > 0)
        {

            foreach($badges as $badge)
            {

                if(!$user->badges->contains('id', $badge->id))
                {

                    $result = false;
                    break;

                }

            }

        }

        return $result;

    }

}