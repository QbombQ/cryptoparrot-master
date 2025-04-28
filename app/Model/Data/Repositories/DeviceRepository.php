<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\DeviceRepositoryInterface;
use App\Model\Data\Models\Device;

class DeviceRepository implements DeviceRepositoryInterface
{

    public function createOrUpdate($data)
    {

        $device = Device::where('firebase_token', $data['firebase_token'])->first();

        if($device)
        {

            $device->update($data);

        }else{

            Device::updateOrCreate([
                'unique_id'   => $data['unique_id'],
            ], $data);

        }

    }

    public function getUserDevices($userId)
    {

        return Device::where('user_id', $userId)->get();

    }

    public function getUsersDevices($userIds)
    {

        return Device::whereIn('user_id', $userIds)->get();

    }

}