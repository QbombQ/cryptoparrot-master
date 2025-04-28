<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\Common\TokenServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Data\Models\TradeComment;
use App\Model\Data\Models\User;
use App;
use Log;

class TradeCommentObserver
{

    protected $tokenService;
    protected $emailService;
    protected $notificationService;

    const TRADE_COMMENTED_NOTIFICATION_ID = 2;
    const NEW_REPLY_NOTIFICATION_ID = 9;
	
    public function __construct(TokenServiceInterface $tokenService,
                                NotificationServiceInterface $notificationService,
                                EmailServiceInterface $emailService)
	{
		
        $this->tokenService = $tokenService;
        $this->emailService = $emailService;
        $this->notificationService = $notificationService;
		
	}    

    public function created(TradeComment $comment)
    {

        $mentionService = App::make('App\Model\Contracts\Interfaces\Services\Common\MentionServiceInterface');
        $mentionService->mention($comment->comment, $comment->trade, $comment->author->username);

        if($comment->reply_to == null)
        {

            if($comment->user_id != $comment->trade->user_id)
            {

                if($comment->trade->author->notificationSettings->comments == 1)
                {

                    $notification = $this->notificationService->createNotification(
                        $comment->trade->user_id,
                        self::TRADE_COMMENTED_NOTIFICATION_ID,
                        trans('notifications.trade_commented', [$comment->author->username, $comment->trade->id]),
                        url($comment->trade->author->handle).'/trade/'.$comment->trade->id
                    );

                    if(!$comment->trade->author->isOnline())
                    {

                        $this->emailService->sendNotificationAboutNewTradeComment($comment->author, $comment->trade->author, $comment->trade_id);

                    }

                }    

            }

        } else {

            $parentComment = TradeComment::find($comment->reply_to);

            if($parentComment && $parentComment->user_id != $comment->user_id)
            {

                if($parentComment->author->notificationSettings->comments == 1)
                {

                    $notification = $this->notificationService->createNotification(
                        $parentComment->user_id,
                        self::NEW_REPLY_NOTIFICATION_ID,
                        trans('notifications.new_reply', [$comment->author->username]),
                        url($comment->trade->author->handle).'/trade/'.$comment->trade->id
                    );

                    if(!$comment->trade->author->isOnline())
                    {

                        $this->emailService->sendNotificationAboutNewTradeComment($comment->author, $comment->trade->author, $comment->trade_id);

                    } 

                }  

            }
            
        }
		
    }    

}