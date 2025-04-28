<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\UserNotificationSettingRepositoryInterface;
use App\Model\Data\Models\UserNotificationSetting;

class UserNotificationSettingRepository implements UserNotificationSettingRepositoryInterface
{


    public function deleteByUserId($userId)
    {

        UserNotificationSetting::where('user_id', $userId)->delete();

    }

    public function create($data)
    {

        $userNotificationSetting = new UserNotificationSetting;
        $userNotificationSetting->fill($data);
        $userNotificationSetting->save();

    }

    public function update($id, $data)
    {

        $setting = UserNotificationSetting::findOrFail($id);
        $setting->fill($data);
        $setting->save();

    }

}