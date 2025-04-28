<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface NotificationServiceInterface
{

    public function createNotification($userId, $typeId, $text, $url, $itemType, $itemId);

    public function delete($userId, $typeId, $text, $url);

    public function markNotificationsAsRead($userId);

    public function paginate($userId, $limit);

    public function paginateAjax($userId, $limit);

    public function unsubscribeNewsletter($token);

    public function notificationExists($userId, $typeId);

    public function getUnreadNotNotifiedByEmail();

    public function notifyUsersAboutUnreadNotifications();

}