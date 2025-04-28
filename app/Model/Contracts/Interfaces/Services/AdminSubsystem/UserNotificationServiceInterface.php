<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface UserNotificationServiceInterface
{

    public function sendMassNotifications($data);

}