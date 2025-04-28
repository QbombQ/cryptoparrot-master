<?php

namespace App\Model\Contracts\Interfaces\Formatters\Common;

interface NotificationFormatterInterface
{

    public function prepareNotificationsForBubbleDisplay($notifications);

    public function prepareNotificationsForNotificationsPage($notifications);

}