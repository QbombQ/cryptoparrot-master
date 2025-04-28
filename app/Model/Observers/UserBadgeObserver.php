<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Data\Models\UserBadge;

class UserBadgeObserver
{

    protected $notificationService;
    protected $emailService;

    const BADGE_RECEIVED_NOTIFICATION_ID = 5;
	
    public function __construct(
        NotificationServiceInterface $notificationService,
        EmailServiceInterface $emailService
    )
	{

        $this->notificationService = $notificationService;
        $this->emailService = $emailService;
		
	}    

    public function created(UserBadge $userBadge)
    {
        
        $notification = $this->notificationService->createNotification(
            $userBadge->user_id,
            self::BADGE_RECEIVED_NOTIFICATION_ID,
            trans('notifications.badge_given', [$userBadge->badge->title]),
            url('/'.$userBadge->user->handle)
        );

        if(!$userBadge->user->isOnline())
        {

            $this->emailService->sendNotificationAboutNewBadge(
                $userBadge->user->email,
                $userBadge->badge->title, 
                $userBadge->user->handle,
                $userBadge->user->username
            ); 
            
        }           
		
    }    

}