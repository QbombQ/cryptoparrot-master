<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserNotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\FrontSubsystem\DeviceServiceInterface;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\CompetitionRepositoryInterface;
use App\Jobs\SendMassNotification;

class UserNotificationService implements UserNotificationServiceInterface
{

    private $userRepository;
    private $notificationService;
    private $competitionRepository;
    private $deviceService;

    const SIGNAL_NOTIFICATION_ID = 16;

    public function __construct(
        UserRepositoryInterface $userRepository,
        NotificationServiceInterface $notificationService,
        CompetitionRepositoryInterface $competitionRepository,
        DeviceServiceInterface $deviceService
    )
    {

        $this->userRepository = $userRepository;
        $this->notificationService = $notificationService;
        $this->competitionRepository = $competitionRepository;
        $this->deviceService = $deviceService;
        
    }

    public function sendMassNotifications($data)
    {

        if(array_key_exists('test_handle', $data) && $data['test_handle'])
        {

            $user = $this->userRepository->getByHandle($data['test_handle']);
            $this->notificationService->createNotification(
                $user->id,
                self::SIGNAL_NOTIFICATION_ID,
                $data['text'],
                $data['url']
            );
            
        } else {

            if($data['competition'] !== 'none')
            {

                $competition = $this->competitionRepository->getById($data['competition']);
                $users = $competition->participants;
                
            }else{
            
                $users = $this->userRepository->all();
            
            }

            SendMassNotification::dispatch($users, $data['text'], $data['url'])->onQueue(env('PREFIX').'-low');

        }
        
        return "OK";

    }

}