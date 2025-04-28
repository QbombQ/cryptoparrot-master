<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\BlockedUserFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Avatar;
use Pagination;
use Media;

class BlockedUserFormatter implements BlockedUserFormatterInterface
{

    public function prepareDataForCreate($blockedBy, $blockedUserId)
    {

        return [
            'blocked_by' => $blockedBy,
            'blocked_user_id' => $blockedUserId
        ];

    }

    public function prepareBlockedUsers($blockedUsers)
    {

        $results['data'] = [];

        if($blockedUsers instanceof LengthAwarePaginator) 
        {

            $results['pagination'] = Pagination::defaultPagination($blockedUsers);

        }

        if($blockedUsers->count() > 0)
        {

            foreach($blockedUsers as $user)
            {

                $results['data'][] = [
                    'id' => $user->blockedUser->id,
                    'username' => $user->blockedUser->username,
                    'avatar' => Media::getUserAvatar($user->blockedUser)
                ];

            }
            
        }

        return $results;

    }

}