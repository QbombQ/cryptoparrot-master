<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\ExchangeFormatterInterface;
use Auth;
use Time;

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


    public function prepareExchangeHistoryForDisplay($exchanges)
    {

        $result = [];

        if(!$exchanges->isEmpty())
        {

            foreach($exchanges as $exchange)
            {

                $result[] = [
                    'amount' => $exchange->amount,
                    'exchange_to' => $exchange->exchange_to,
                    'exchange_rate' => sprintf('%f', $exchange->exchange_rate),
                    'exchanged_amount' => sprintf('%f', $exchange->exchanged_amount),
                    'invoice_address' => $exchange->invoice_address,
                    'status' => $exchange->status,
                    'date' => Time::formatDateForHumans($exchange->created_at)
                ];

            }

        }

        return $result;

    }

    public function prepareForCreate($data, $user)
    {

        $parsedAddress = str_replace('lightning:', '', $data['invoiceAddress']);
        $multipliers = [
            'u' => 0.000001,
            'm' => 0.001,
            'n' => 0.000000001,
            'p' => 0.000000000001
        ];
        $regex = '/lnbc([0-9]+)0(m|u|n|p).+/m';
        preg_match_all($regex, $parsedAddress, $matches, PREG_SET_ORDER, 0);

        $invoiceAmountSats = $matches[0][1];
        $rate = (int) ($invoiceAmountSats / ($data['amount_play_dollars'] / 1000.0));

        return [
            'user_id' => $user->id,
            'amount' => $data['amount_play_dollars'],
            'exchange_rate' => $rate,
            'exchange_to' => 'BTC',
            'exchanged_amount' => $invoiceAmountSats,
            'invoice_address' => $data['invoiceAddress'],
            'status' => 'completed',
            'ip' => $user->ip,
            'portfolio_id' => $user->main_portfolio_id
        ];
 
    } 
 
    public function prepareForCreateFailed($data, $user)
    {

        return [
            'user_id' => $user->id,
            'amount' => $data['amount_play_dollars'],
            'exchange_rate' => config('custom.satoshi_reward_per_thousand_play_dollars'),
            'exchange_to' => 'BTC',
            'exchanged_amount' => ($data['amount_play_dollars'] / 1000.0) * config('custom.satoshi_reward_per_thousand_play_dollars'),
            'invoice_address' => $data['invoiceAddress'],
            'status' => 'failed',
            'portfolio_id' => $user->main_portfolio_id,
            'ip' => $user->ip
        ];

    }

    public function prepareCreationFailResponse($error)
    {

        return [
            'success' => false,
            'message' => $error
        ];

    }

    public function parseLightningAddress($address)
    {

        return str_replace('lightning:', '', $address);

    }

    public function extractAddressParts($address)
    {

        $multipliers = [
			'u' => 0.000001,
			'm' => 0.001,
			'n' => 0.000000001,
			'p' => 0.000000000001
		];
		$regex = '/lnbc([0-9]+)(m|u|n|p).+/m';
        preg_match_all($regex, $address, $matches, PREG_SET_ORDER, 0);
        
        return $matches;

    }

    public function prepareCallbackForFinish($response)
    {

        return [
            'amount_satoshies' => $response['amount_satoshies'],
            'amount_play_dollars' => $response['amount_play_dollars'],
            'amount_play_dollars_formatted' => $response['amount_play_dollars_formatted'],
            'amount_BTC' => $response['amount_BTC'],
            'invoiceAddress' => $response['invoice_address']
        ]; 

    }

    public function preparePayloadForRequest($invoiceAddress, $amount, $amountUsd)
    {

		$payload = new \stdClass;
        $payload->profile_id = env('LN_PROFILE_ID');
        $payload->passthrough = json_encode([
            'user_id' => Auth::id(),
            'invoice_address' => $invoiceAddress,
            'amount_satoshies' => $amount,
            'amount_play_dollars' => $amountUsd,
            'amount_play_dollars_formatted' => '$'.number_format($amountUsd),
            'amount_BTC' => $amount / config('custom.play_usd_btc_rate'),
        ]); 
        $payload->kind = 'lightning-to-lightning';
		$recipient = new \stdClass; 
		$recipient->amount = $amount / config('custom.play_usd_btc_rate');
		$recipient->currency = "BTC"; 
		$recipient->address = $invoiceAddress;
		$recipient->notes = "Note";
		$payload->recipients = [];
        $payload->recipients[] = $recipient;

        return $payload;

    }

}