<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\ExchangeFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;

class ExchangeFormatter implements ExchangeFormatterInterface
{

    public function prepareExchangesForDisplay($exchanges)
    {

        $results = [
            'exchanges' => [],
            'pagination' => ''
        ];

        if($exchanges instanceof LengthAwarePaginator) 
        {

            $results['pagination'] = Pagination::defaultPagination($exchanges);

        }        

        if(!$exchanges->isEmpty())
        {

            foreach($exchanges as $exchange)
            {

                $results['exchanges'][] = [
                    'amount' => $exchange->amount,
                    'exchange_to' => $exchange->exchange_to,
                    'exchange_rate' => $exchange->exchange_rate,
                    'exchanged_amount' => $exchange->exchanged_amount,
                    'invoice_address' => $exchange->invoice_address,
                    'status' => $exchange->status,
                    'user' => $exchange->user->handle,
                    'date' => ($exchange->created_at->diffInDays() < 10) ? $exchange->created_at->diffForHumans() : $exchange->created_at->format('j M, Y')
                ];

            }

        }

        return $results;

    }

}