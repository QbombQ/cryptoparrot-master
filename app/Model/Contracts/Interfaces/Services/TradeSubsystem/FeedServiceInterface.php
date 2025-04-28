<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface FeedServiceInterface
{

    public function getFeed($page, $timestamp, $myFeed);

}