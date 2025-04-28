<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\SponsorFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;
use Illuminate\Support\Facades\Storage;

class SponsorFormatter implements SponsorFormatterInterface
{

    public function prepareSponsorsForDisplay($sponsors)
    {

        $results = [
            'sponsors' => [],
            'pagination' => ''
        ];

        if($sponsors instanceof LengthAwarePaginator) 
        {

            $results['pagination'] = Pagination::defaultPagination($sponsors);

        }        

        if($sponsors->count() > 0)
        {

            foreach($sponsors as $sponsor)
            {

                $results['sponsors'][] = [
                    'id' => $sponsor->id,
                    'title' => $sponsor->title,
                    'url' => $sponsor->url,
                    'logo' => $sponsor->logo
                ];

            }

        }

        return $results;
    
    }

    public function prepareDataForCreation($data)
    {

        return [
            'title' => $data['title'],
            'url' => $data['url']
        ];

    }

    public function prepareDataForUpdate($data)
    {

        return [
            'title' => $data['title'],
            'url' => $data['url']
        ];        

    }

    public function prepareSponsorForEdit($sponsor)
    {

        return [
            'id' => $sponsor->id,
            'title' => $sponsor->title,
            'url' => $sponsor->url,
            'logo' => Storage::disk('public')->url($sponsor->logo)
        ];        

    }    

    public function prepareSponsorsForSelect($sponsors)
    {

        $result = [];

        if($sponsors->count() > 0)
        {

            foreach($sponsors as $sponsor)
            {

                $result[$sponsor->id] = $sponsor->title;
                
            }
            
        }

        return $result;

    }

}