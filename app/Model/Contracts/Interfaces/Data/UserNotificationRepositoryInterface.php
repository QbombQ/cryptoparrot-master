<?php

namespace App\Model\Contracts\Interfaces\Data;

interface UserNotificationRepositoryInterface
{

    public function deleteByUserId($userId);

    public function markAsReadByUserId($userId);

    public function paginate($userId, $limit);

    public function create($userId, $typeId, $text, $url, $itemType = null, $itemId = null);

    public function delete($userId, $typeId, $text, $url);

    public function notificationExists($userId, $typeId);

    public function getUnreadNotNotifiedByEmail();

    public function markAsNotifiedByEmail($userIds);

}