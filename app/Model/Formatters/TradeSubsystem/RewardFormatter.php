<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\RewardFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Pagination;
use Number;

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

                $results['rewards'][] = $this->prepareRewardForDisplay($reward);

            }

        }

        return $results;

    }

    public function prepareRewardForDisplay($reward)
    {

        $data = [ 
            'id' => $reward->id,
            'title' => $reward->title,
            'quantity' => $reward->quantity,
            'price' => Number::niceNumber($reward->price),
            'priceNoFormat' => $reward->price,
            'additional_info' => $reward->info,
            'url' => $reward->url,
            'image' => $reward->image ? Storage::disk('public')->url($reward->image) : '',
            'description' => $reward->description
        ];

        $sponsor = $reward->sponsor;

        if($sponsor)
        {

            $data['sponsor'] = [
                'title' => $sponsor->title,
                'logo' => $sponsor->logo,
                'url' => $sponsor->url,
            ];

        }

        return $data;

    }

    public function prepareMyRewardsForDisplay($userRewards)
    {

        $data = [];

        if(!$userRewards->isEmpty())
        {

            foreach($userRewards as $userReward)
            {

                $reward = $userReward->reward;
                $data[] = [
                    'title' => $reward->title,
                    'description' => $reward->description,
                    'additional_info' => $userReward->additional_info,
                    'date' => \Carbon\Carbon::parse($userReward->updated_at)->format('j M, Y'),
                    'price_paid' => $userReward->price_paid
                ];

            }

        }

        return $data;

    }

    public function prepareCreationFailResponse($message)
    {

        return [
            'success' => false,
            'message' => $message
        ];

    }

    public function prepareForCreation($data)
    {

        return [
            'user_id' => $data['user_id'],
            'reward_id' => $data['reward_id'],
            'price_paid' => $data['price'],
            'full_name' => $data['full_name'],
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => array_key_exists('address_line_2', $data) ? $data['address_line_2'] : null,
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'postcode' => $data['postcode'],
            'additional_info' => $data['additional_info']
        ];

    }

    public function prepareCreationSuccessResponse($message)
    {

        return [
            'success' => true,
            'message' => $message
        ];

    }

}