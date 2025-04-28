<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface BlockedUserFormatterInterface
{

    public function prepareDataForCreate($blockedBy, $blockedUserId);

    public function prepareBlockedUsers($blockedUsers);

}