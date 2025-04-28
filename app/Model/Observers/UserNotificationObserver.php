<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\FrontSubsystem\DeviceServiceInterface;
use App\Model\Events\UserNotification as UserNotificationEvent;
use App\Model\Data\Models\UserNotification;
use Log; 

class UserNotificationObserver
{

    protected $notificationService;
    protected $deviceService;
	
    public function __construct(
        NotificationServiceInterface $notificationService,
        DeviceServiceInterface $deviceService
    )
	{

        $this->notificationService = $notificationService;
        $this->deviceService = $deviceService;
		
	}    

    public function created(UserNotification $userNotification)
    {
        
        event(new UserNotificationEvent($userNotification));

        if($userNotification->type_id !== 16) // Signal
        {

            $devices = $this->deviceService->getUserDevices($userNotification->user_id);

            if($devices->count() > 0)
            {
    
                $recipients = $devices->pluck('firebase_token')->toArray();
    
                fcm()
                ->to($recipients)
                ->data([
                    'url' => $userNotification->url
                ])
                ->notification([
                    'title' => $userNotification->type ? $userNotification->type->title : '',
                    'body' => $userNotification->text,
                ])
                ->send();
    
            }

        }
		
    }    

}