<?php

namespace App\Model\Services\FrontSubsystem;

use App\Model\Contracts\Interfaces\Services\FrontSubsystem\DeviceServiceInterface;
use App\Model\Contracts\Interfaces\Data\DeviceRepositoryInterface;
use Log;

class DeviceService implements DeviceServiceInterface
{

    protected $deviceRepository;

	public function __construct(DeviceRepositoryInterface $deviceRepository) 
	{

		$this->deviceRepository = $deviceRepository;
		
	}	

    public function createOrUpdate($data)
    {

        unset($data['secret']);
        $data['user_id'] = intval($data['user_id']);

        try {

            $this->deviceRepository->createOrUpdate($data);
        
        }catch(\Exception $e)
        {

            return [
                'success' => false,
                'message' => trans('FrontSubsystem/error-messages.data-missing')
            ];

        }

        return [
            'success' => true,
            'message' => 'OK'
        ];

    }

    public function getUserDevices($userId)
    {

        return $this->deviceRepository->getUserDevices($userId);

    }

    public function getUsersDevices($userIds)
    {

        return $this->deviceRepository->getUsersDevices($userIds);

    }

}