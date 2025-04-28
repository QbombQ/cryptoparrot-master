<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\InvitedUserFormatterInterface;
use Illuminate\Support\Facades\Storage;
use Avatar;
use Media;

class InvitedUserFormatter implements InvitedUserFormatterInterface
{

    public function prepareInvitedUsersForDisplay($invitedUsers)
    {

        $response['count'] = 5;
        $response['html'] = '';

        if($invitedUsers->count() > 0)
        {

            $response['success'] = true;
            $data['invitedUsers'] = [];

            foreach($invitedUsers as $user)
            {

                $invitedUser = $user->invitedUser;
                $verified = $invitedUser->status == 'confirmed';
                $hasTrades = $invitedUser->trades->count() > 0;

                if($verified && $hasTrades)
                {

                    $response['count']--;

                    if($response['count'] < 0)
                    {

                        $response['count'] = 0;

                    }

                }

                $data['invitedUsers'][] = [
                    'username' => $invitedUser->username,
                    'handle' => $invitedUser->handle,
                    'verified' => $verified,
                    'hasTrades' => $hasTrades,
                    'avatar' => Media::getUserAvatar($invitedUser)
                ];

            }

            $response['html'] = view('pages/TradeSubsystem/common/invited-users', $data)->render();

        } else {

            $response['success'] = false;
            $response['html'] = view('pages/TradeSubsystem/common/invited-users', ['invitedUsers' => []])->render();
            
        }

        return $response;

    }

}