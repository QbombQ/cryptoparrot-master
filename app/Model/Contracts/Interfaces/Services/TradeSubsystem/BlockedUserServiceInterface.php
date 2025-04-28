<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface BlockedUserServiceInterface
{

    public function blockUser($blockedBy, $blockedUserId);

    public function unBlockUser($blockedBy, $blockedUserId);

    public function paginate($userId);

}