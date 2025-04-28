<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\InvitedUserFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;
use Carbon\Carbon;

class InvitedUserFormatter implements InvitedUserFormatterInterface
{

    public function prepareInvitedUsersForDisplay($invitedUsers)
    {

        $results = [
            'invitedUsers' => [],
            'pagination' => ''
        ];

        if($invitedUsers instanceof LengthAwarePaginator) 
        {

            $results['pagination'] = Pagination::defaultPagination($invitedUsers);

        }        

        if($invitedUsers->count() > 0)
        {

            foreach($invitedUsers as $user)
            {

                $results['invitedUsers'][] = [
                    'id' => $user->id,
                    'username' => '<a href="/'.$user->invitedUser->handle.'">'.$user->invitedUser->username.'</a>',
                    'trades' => $user->invitedUser->trades->count(),
                    'invitedBy' => '<a href="/'.$user->invitedUser->handle.'">'.$user->invitedByUser->username.'</a>' . ' (' . $user->invitedByUser->invitedUsers->count() . ')',
                    'registeredAt' => Carbon::parse($user->created_at)->toDateTimeString()
                ];
                
            }

        }

        return $results;

    }

}