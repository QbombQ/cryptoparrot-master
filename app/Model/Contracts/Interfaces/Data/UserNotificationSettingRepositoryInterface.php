<?php

namespace App\Model\Contracts\Interfaces\Data;

interface UserNotificationSettingRepositoryInterface
{

    public function deleteByUserId($userId);

    public function create($data);

    public function update($id, $data);

}