<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface FollowFormatterInterface
{

    public function prepareFollowersForDisplay($follows);

    public function prepareFollowingsForDisplay($follows);

    public function prepareDataForCreation($followingId, $followerId);

}