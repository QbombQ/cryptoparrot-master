<?php

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Services\Common\CurlServiceInterface;
use GuzzleHttp\Client;

class CurlService implements CurlServiceInterface
{

    public function cryptoChillRequest($endpoint, $payload, $method = 'GET')
	{

		$payload->request = '/v1/'.$endpoint.'/';
		$payload->nonce = time() * 1001; 
	
		$encoded_payload = json_encode($payload);
		$b64 = base64_encode($encoded_payload);
		$signature = hash_hmac ( 'sha256' , $b64 , env('LN_API_KEY'));
	
		$request_headers = [
			'X-CC-KEY' => env('LN_API_SECRET'),
			'X-CC-PAYLOAD' => $b64,
			'X-CC-SIGNATURE' => $signature
        ];

		try {

			$client = new Client();
			$request = $client->request($method, 'https://api.cryptochill.com/v1/'.$endpoint.'/', [
				'headers' => $request_headers
			]);
			$statusCode = $request->getStatusCode();

			if($statusCode !== 200 && $statusCode !== 201)
			{
				
				return false;

            }
            
			return true;

		}catch(\Exception $e)
		{

            $responseContent = json_decode($e->getResponse()->getBody()->getContents(), true);
            
            return $responseContent['message'];
			
		} 

    }

    public function getWebsiteHTML($url)
    {

        return file_get_contents($url);        

    }

    public function getMultiPriceCurrencyRates($fSyms)
    {

        $client = new Client();
		$res = $client->request('GET', 'https://min-api.cryptocompare.com/data/pricemulti?fsyms='.$fSyms.'&tsyms=USD');	
		return json_decode($res->getBody(), true);        

    }

    public function getCurrencyDayAverage($currency)
    {

        $client = new Client();
        $res = $client->request('GET', 'https://min-api.cryptocompare.com/data/generateAvg?fsym='.$currency.'&tsym=USD&e=CCCAGG');	
        return json_decode($res->getBody(), true);        

    }

}