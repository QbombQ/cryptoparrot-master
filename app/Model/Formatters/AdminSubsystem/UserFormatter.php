<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\UserFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;
use Carbon\Carbon;

class UserFormatter implements UserFormatterInterface
{

    public function prepareUserActivityForDisplay($usersFromCache)
    {

        if(!$usersFromCache)
        {
            
            return [];

        }

        $result = [];

        foreach($usersFromCache as $user)
        {

            $result[] = [
                'username' => $user->username,
                'activeAt' => Carbon::parse($user->active_at)->diffForHumans(Carbon::now(), true, true, 3) . ' ago'
            ];

        }

        return $result;

    }

    public function prepareUsersForDisplay($users)
    {

        $results = [
            'users' => [],
            'pagination' => ''
        ];

        if($users instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($users); 

        }        

        if($users->count() > 0)
        {

            foreach($users as $user)
            {

                $results['users'][] = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'slug' => $user->handle,
                    'email' => $user->email,
                    'method' => $user->method,
                    'status' => $user->status,
                    'ref_code' => $user->ref_code,
                    'date' => $user->created_at->format('j M, Y')
                ];

            }

        }

        return $results;        

    }

    public function prepareUserForEditDisplay($user)
    {

        return [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'status' => $user->status,
            'ghosted' => $user->ghosted
        ];

    }

    public function prepareRequestDataForUpdate($userBeforeUpdate, $data)
    {

        return [
            'username' => $data['username'],
            'email' => $data['email'],
            'status' => $userBeforeUpdate->email !== $data['email'] ? 'unconfirmed' : $data['status'],
            'ghosted' => $data['ghosted'] && $data['ghosted'] == 'on' ? 1 : 0
        ];

    }

    public function prepareUsersForSelect($users)
    {

        $result = [];

        if($users->count() > 0)
        {

            foreach($users as $user)
            {

                $result[$user->id] = $user->username;

            }
            
        }

        return $result;

    }

    public function prepareUserForMainPortfolioUpdate($portfolioId)
    {

        return [
            'main_portfolio_id' => $portfolioId
        ];

    }

    public function prepareUserForCurrentPortfolioUpdate($portfolioId)
    {

        return [
            'current_portfolio_id' => $portfolioId
        ];

    }

}