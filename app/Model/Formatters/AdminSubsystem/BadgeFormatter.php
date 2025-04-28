<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\BadgeFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;

class BadgeFormatter implements BadgeFormatterInterface
{

    public function prepareBadgesForDisplay($badges)
    {

        $results = [
            'badges' => [],
            'pagination' => ''
        ];

        if($badges instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($badges);

        }        

        if($badges->count() > 0)
        {

            foreach($badges as $badge)
            {

                $results['badges'][] = [
                    'id' => $badge->id,
                    'title' => $badge->title,
                    'icon' => $badge->icon,
                    'is_branded' => $badge->is_branded,
                    'description' => $badge->description
                ];

            }
 
        }

        return $results;

    }

    public function prepareBadgesForSelect($badges)
    {

        $result = [];

        if($badges->count() > 0)
        {

            foreach($badges as $badge)
            {

                $result[$badge->id] = $badge->title;

            }
            
        }

        return $result;

    }

    public function prepareDataForCreation($data)
    {

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'icon' => $data['icon'],
            'is_branded' => $data['is_branded'] == 'on' ? 1 : 0
        ];

    }

    public function prepareDataForUpdate($data)
    {

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'icon' => $data['icon'],
            'is_branded' => $data['is_branded'] == 'on' ? 1 : 0
        ];        

    }

    public function prepareForEdit($badge)
    {

        return [
            'id' => $badge->id,
            'title' => $badge->title,
            'icon' => $badge->icon,
            'is_branded' => $badge->is_branded,
            'description' => $badge->description
        ];

    }

    public function prepareGiveResponseWithError($message)
    {

        return [
            'success' => false,
            'message' => $message
        ];

    }

    public function prepareGiveResponse($message)
    {

        return [
            'success' => true,
            'message' => $message
        ];

    }    

}