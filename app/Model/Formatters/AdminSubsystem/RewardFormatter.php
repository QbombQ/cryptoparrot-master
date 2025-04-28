<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\RewardFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;
use Illuminate\Support\Facades\Storage;

class RewardFormatter implements RewardFormatterInterface
{

    public function prepareRewardsForDisplay($rewards)
    {

        $results = [
            'rewards' => [],
            'pagination' => ''
        ];

        if($rewards instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($rewards);

        }        

        if($rewards->count() > 0)
        {

            foreach($rewards as $reward)
            {

                $results['rewards'][] = [
                    'id' => $reward->id,
                    'title' => $reward->title,
                    'quantity' => $reward->quantity,
                    'price' => $reward->price,
                    'info' => $reward->info,
                    'url' => $reward->url
                ];

            }

        }

        return $results;
    
    }

    public function prepareDataForCreation($data)
    {

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'url' => $data['url'],
            'info' => $data['info'],
            'quantity' => $data['quantity'],
            'sponsor_id' => array_key_exists('sponsor', $data) ? $data['sponsor'] : null
        ];

    }

    public function prepareDataForUpdate($data)
    {

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'url' => $data['url'],
            'info' => $data['info'],
            'quantity' => $data['quantity'],
            'sponsor_id' => array_key_exists('sponsor', $data) ? $data['sponsor'] : null
        ];        

    }

    public function prepareRewardForEdit($reward)
    {

        return [
            'id' => $reward->id,
            'title' => $reward->title,
            'description' => $reward->description,
            'price' => $reward->price,
            'quantity' => $reward->quantity,
            'url' => $reward->url,
            'info' => $reward->info,
            'sponsor_id' => $reward->sponsor_id,
            'image' => Storage::disk('public')->url($reward->image)
        ];

    }    

    public function prepareUserRewardsForDisplay($userRewards)
    {

        $results = [
            'userRewards' => [],
            'pagination' => ''
        ];

        if($userRewards instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($userRewards);

        }        

        if($userRewards->count() > 0)
        {

            foreach($userRewards as $reward)
            {

                $results['userRewards'][] = [
                    'id' => $reward->id,
                    'user' => $reward->user->username,
                    'handle' => $reward->user->handle,
                    'email' => $reward->user->email,
                    'reward' => $reward->reward->title,
                    'full_name' => $reward->full_name,
                    'address_line_1' => $reward->address_line_1,
                    'address_line_2' => $reward->address_line_2,
                    'city' => $reward->city,
                    'state' => $reward->state,
                    'country' => $reward->country,
                    'postcode' => $reward->postcode,
                    'additional_info' => $reward->additional_info,
                    'status' => $reward->status
                ];

            }
            
        }

        return $results;

    }

    public function prepareFailResponse($message)
    {

        return [
            'success' => false,
            'message' => $message
        ];

    }

    public function prepareSuccessResponse($message)
    {

        return [
            'success' => true,
            'message' => $message
        ];

    }

}