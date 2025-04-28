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
                    'price' => $reward->price
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
            'sponsor_id' => $reward->sponsor_id,
            'image' => Storage::disk('public')->url($reward->image)
        ];        

    }    

}