<?php

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Services\Common\MentionServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Data\Models\User;

class MentionService implements MentionServiceInterface
{

    protected $notificationService;

    const NEW_MENTION_NOTIFICATION_ID = 10;

    public function __construct(
        NotificationServiceInterface $notificationService
    )
    {

        $this->notificationService = $notificationService;

    }

    public function mention($text, $trade, $mentionedBy)
    {

        preg_match_all('#<a\s+href\s*=\s*"([^"]+)"[^>]*>([^<]+)</a>#i', $text, $matches, PREG_SET_ORDER);
        $mentions = [];

        if(count($matches) > 0)
        {

            foreach($matches as $match)
            {

                $nickname = substr($match[2], 1);

                if(in_array($nickname, $mentions))
                {

                    continue;

                }

                array_push($mentions, $nickname);
                $user = User::where('username', $nickname)->first();

                if($user)
                {

                    $this->notificationService->createNotification(
                        $user->id,
                        self::NEW_MENTION_NOTIFICATION_ID,
                        trans('notifications.user_mentioned', [$mentionedBy]),
                        url($trade->author->handle).'/trade/'.$trade->id
                    );
                
                }
            
            }
        
        }

    }

}