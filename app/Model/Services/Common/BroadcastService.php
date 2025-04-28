<?php

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Services\Common\BroadcastServiceInterface;
use Cache;
use App\Model\Events\CurrencyUpdated;
use Carbon\Carbon;
use Currency; 
use App\Model\Data\Models\TradePair;
use App\Model\Data\Models\Currency as CurrencyModel;
use Log;

class BroadcastService implements BroadcastServiceInterface
{

    private function getChangeDirection($pairId, $type, $price)
    {

        $direction = 'stay';

        if(Cache::has('pair-rate-'.$type.'-'.$pairId)) 
        {

            $oldPrice = Cache::get('pair-rate-'.$type.'-'.$pairId);

            if($oldPrice < $price) 
            {

                $direction = 'up';

            }elseif($oldPrice > $price) 
            {

                $direction = 'down';

            }

        }

        return $direction;

    }

    private function formatAcronyms($pairId)
    {

        if(strlen($pairId) == 6) $response['from'] = substr($pairId, 0, 3);
        elseif(strlen($pairId) == 7) $response['from'] = substr($pairId, 0, 4);
        elseif(strlen($pairId) == 8) $response['from'] = substr($pairId, 0, 5);
        elseif(strlen($pairId) == 4) $response['from'] = substr($pairId, 0, 1);
         
        $response['to'] = substr($pairId, -3);

        return $response;

    }

    private function updateTradePairChange($acronyms, $type, $change)
    {

        $fromCurrency = CurrencyModel::where('acronym', $acronyms['from'])->first();
        $toCurrency = CurrencyModel::where('acronym', $acronyms['to'])->first();

        if($fromCurrency && $toCurrency)
        {

            $tradePair = TradePair::where('from_currency_id', $fromCurrency->id)->where('to_currency_id', $toCurrency->id)->first();

            if($type === 'buy')
            {

                $tradePair->change = $change === null ? 0 : $change;

            }else{

                $tradePair->change_sell = $change === null ? 0 : $change;

            }
            
            $tradePair->save();

        }

    } 

    private function formatPriceBeforeBroadcast($acronyms, $type, $pairId, $price)
    {

        $precision = Currency::getClass($acronyms['from'])->precisionIn($acronyms['to']);
        Cache::put('pair-rate-'.$type.'-'.$pairId, $price, Carbon::now()->addMinutes(20));
        $price = number_format($price, $precision, '.', ',');

        return $price;

    }

    public function broadcastPrice($type, $price, $change, $pairId)
    {

        $acronyms = $this->formatAcronyms($pairId);   
        $this->updateTradePairChange($acronyms, $type, $change);

        event(
            new CurrencyUpdated(
                $pairId,
                $this->formatPriceBeforeBroadcast($acronyms, $type, $pairId, $price),
                $this->getChangeDirection($pairId, $type, $price),
                $change,
                $type
            )
        );
        
        return;

    }

    public function broadcastPriceChange()
    {
 

        request()->validate([
            'pair_id' => 'required',
            'secret' => 'required|in:' . env('API_SECRET_KEY'),
            //'price_buy' => 'required',
            //'price_sell' => 'required',
            //'change_buy' => 'required',
            //'change_sell' => 'required'
        ]);

        $this->broadcastPrice('buy', request()->price, request()->change, request()->pair_id);
        //$this->broadcastPrice('buy', request()->price_buy, request()->change_buy, request()->pair_id);
        //$this->broadcastPrice('sell', request()->price_sell - 2, request()->change_sell, request()->pair_id);

        return "Success";

    }

}