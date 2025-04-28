<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\FollowFormatterInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Avatar;
use Balance;
use Pagination;
use Media;

class FollowFormatter implements FollowFormatterInterface
{

    public function prepareFollowersForDisplay($follows)
    {

        $results = [];

        if($follows instanceof LengthAwarePaginator)
        {
            
            $results['pagination'] = Pagination::defaultPagination($follows);      

        }

        if($follows->count() > 0)
        {

            foreach($follows as $follow)
            {

                $user = $follow->follower;

                if($user)
                {

                    $results['data'][] = [
                        'userId' => $user->id,
                        'handle' => $user->handle,
                        'username' => $user->username ? $user->username : null,
                        'avatar' => Media::getUserAvatar($user),
                        'totalBalance' => Balance::portfolioTotalValue($user->mainPortfolio),
                        'totalBalanceClass' => Balance::portfolioTotalBalanceClass($user->mainPortfolio)
                    ];

                }

            } 

        }

        return $results;

    }

    public function prepareFollowingsForDisplay($follows)
    {

        $results = [];

        if($follows instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($follows); 

        }

        if($follows->count() > 0)
        {

            foreach($follows as $follow)
            {

                $user = $follow->following;  
                $results['data'][] = [
                    'userId' => $user->id,
                    'handle' => $user->handle,
                    'username' => $user->username ? $user->username : null,
                    'avatar' => Media::getUserAvatar($user),
                    'totalBalance' => Balance::portfolioTotalValue($user->mainPortfolio),
                    'totalBalanceClass' => Balance::portfolioTotalBalanceClass($user->mainPortfolio)                    
                ];

            }
            
        }

        return $results;

    }    

    public function prepareDataForCreation($followingId, $followerId)
    {

        return [
            'follower_id' => $followerId,
            'following_id' => $followingId
        ];

    }

}