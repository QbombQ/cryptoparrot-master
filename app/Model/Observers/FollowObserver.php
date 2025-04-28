<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Events\UserFollowed;
use App\Model\Data\Models\Follow;

class FollowObserver
{

    protected $tokenService;
    protected $emailService;
    protected $notificationService;

    const NEW_FOLLOW_NOTIFICATION_ID = 4;
	
    public function __construct(
        NotificationServiceInterface $notificationService,
        EmailServiceInterface $emailService
    )
	{

        $this->notificationService = $notificationService;
        $this->emailService = $emailService;
		
	}    

    public function created(Follow $follow)
    {

        if($follow->following->notificationSettings->new_follows == 1)
        {

            $notification = $this->notificationService->createNotification(
                $follow->following_id,
                self::NEW_FOLLOW_NOTIFICATION_ID,
                trans('notifications.new_follow', [$follow->follower->username]),
                url($follow->follower->handle)
            );
            
            if(!$follow->following->isOnline())
            {

                $this->emailService->sendNotificationAboutNewFollow($follow->following, $follow->follower);
            
            }
        }
		
    }    

}