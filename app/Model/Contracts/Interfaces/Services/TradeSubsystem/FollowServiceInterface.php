<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface FollowServiceInterface
{

    public function getUserFollowers($userId);

    public function getUserFollowings($userId);

}