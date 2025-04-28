<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Data\Models\TradeVote;

class TradeVoteObserver
{

    protected $notificationService;

    const TRADE_VOTED_NOTIFICATION_ID = 3;
	
    public function __construct(
        NotificationServiceInterface $notificationService
    )
	{

        $this->notificationService = $notificationService;
		
	}    

    public function created(TradeVote $vote)
    {
        
        if($vote->user_id != $vote->trade->user_id)
        {

            if($vote->trade->author->notificationSettings->votes == 1)
            {

                $notification = $this->notificationService->createNotification(
                    $vote->trade->user_id,
                    self::TRADE_VOTED_NOTIFICATION_ID,
                    trans('notifications.trade_voted', [$vote->author->username]),
                    url('/').'/'.$vote->trade->author->handle.'/trade/'.$vote->trade->id
                );

            }

        }
		
    }    

    public function deleted(TradeVote $vote)
    {
        
        if($vote->user_id != $vote->trade->user_id)
        {

            $this->notificationService->delete(
                $vote->trade->user_id,
                3,
                trans('notifications.trade_voted', [$vote->author->username]),
                url('/').'/'.$vote->trade->author->handle.'/trade/'.$vote->trade->id
            );
        
        }
		
    }        

}