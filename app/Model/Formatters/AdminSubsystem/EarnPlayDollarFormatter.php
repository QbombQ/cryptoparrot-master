<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\EarnPlayDollarFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;
use Illuminate\Support\Facades\Storage;

class EarnPlayDollarFormatter implements EarnPlayDollarFormatterInterface
{

    public function prepareEarnPlayDollarsForDisplay($earnPlayDollars)
    {

        $results = [
            'earnPlayDollars' => [],
            'pagination' => ''
        ];

        if($earnPlayDollars instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($earnPlayDollars);

        }        

        if($earnPlayDollars->count() > 0)
        {

            foreach($earnPlayDollars as $earnPlayDollar)
            {

                $results['earnPlayDollars'][] = [
                    'id' => $earnPlayDollar->id,
                    'title' => $earnPlayDollar->title,
                    'quantity' => $earnPlayDollar->quantity,
                    'price' => $earnPlayDollar->price
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
            'quantity' => $data['quantity']
        ];

    }

    public function prepareDataForUpdate($data)
    {

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity']
        ];        

    }

    public function prepareEarnPlayDollarForEdit($earnPlayDollar)
    {

        return [
            'id' => $earnPlayDollar->id,
            'title' => $earnPlayDollar->title,
            'description' => $earnPlayDollar->description,
            'price' => $earnPlayDollar->price,
            'quantity' => $earnPlayDollar->quantity,
            'image' => Storage::disk('public')->url($earnPlayDollar->image)
        ];        

    }    

}