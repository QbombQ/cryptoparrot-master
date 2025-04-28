<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\NewsletterMessageServiceInterface;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use Cache;

class NewsletterMessageService implements NewsletterMessageServiceInterface
{

    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {

        $this->userRepository = $userRepository;

    }

    public function getCurrentProgress()
    {

        $startDate = Cache::get('newsletter-start-date');
        $endDate = Cache::get('newsletter-end-date');
        $totalUsers = Cache::get('newsletter-total-users');
        $messagesSent = Cache::get('newsletter-messages-sent');
        $alreadySent = Cache::get('newsletter-already-sent');
        $problematicUsers = Cache::get('newsletter-problematic-users');
        $percents = 0;
        $usersPassed = 0;

        if($totalUsers)
        {

            $usersPassed = count($messagesSent) + count($alreadySent) + count($problematicUsers);
            $percents = $usersPassed / $totalUsers * 100;

        }

        $messagesSentArray = [];

        if($messagesSent && count($messagesSent) > 0)
        {

            foreach($messagesSent as $id => $date)
            {

                $user = $this->userRepository->get($id);
                if(!$user) continue;
                $messagesSentArray[] = $user->email . ' at ' . $date;

            }

        }

        $alreadySentArray = [];

        if($alreadySent && count($alreadySent) > 0)
        {

            foreach($alreadySent as $id => $date)
            {

                $user = $this->userRepository->get($id);
                if(!$user) continue;
                $alreadySentArray[] = $user->email . ' at ' . $date;

            }

        }

        $problematicUsersArray = [];

        if($problematicUsers && count($problematicUsers) > 0)
        {

            foreach($problematicUsers as $id => $date)
            {

                $user = $this->userRepository->get($id);
                if(!$user) continue;
                $problematicUsersArray[] = $user->username;

            }
            
        }        

        return [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalUsers' => $totalUsers,
            'messagesSent' => $messagesSentArray,
            'alreadySent' => $alreadySentArray,
            'problematicUsers' => $problematicUsersArray,
            'progress' => $percents,
            'usersPassed' => $usersPassed
        ];

    }

}