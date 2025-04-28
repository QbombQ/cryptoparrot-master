<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface BadgeServiceInterface
{

    public function userHasBadges($user, $badges);

}