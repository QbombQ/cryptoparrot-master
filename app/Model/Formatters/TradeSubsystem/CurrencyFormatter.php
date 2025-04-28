<?php 

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\CurrencyFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use Auth;
use Number;
use Currency;

class CurrencyFormatter implements CurrencyFormatterInterface
{

    private $tradeService;

    public function __construct(
        TradeServiceInterface $tradeService
    )
    {

        $this->tradeService = $tradeService;

    }

    public function prepareCurrenciesForTradePage($pairs)
    {

        $results = [];

        if($pairs->count() > 0)
        {

            foreach($pairs as $pair)
            {

                $symbol = $pair->fromCurrency->acronym;
                $toSymbol = $pair->toCurrency->acronym;
                $cryptoCurrency = Currency::getClass($symbol);  
                $precision = $cryptoCurrency->precisionIn($toSymbol); 
                $todaysTradesValues = Auth::user() ? $this->tradeService->getTodayTradesValue(Auth::id(), $pair, Auth::user()->current_portfolio_id) : array('buy'=>0,'sell'=>0);
 
                $data = [
                    'id' => $pair->id,
                    'buy_id' => $pair->from_currency_id,
                    'sell_id' => $pair->to_currency_id,
                    'buy_acronym' => $pair->fromCurrency->acronym,
                    'sell_acronym' => $pair->toCurrency->acronym, 
                    'buy_name' => $pair->fromCurrency->name,
                    'sell_name' => $pair->toCurrency->name,
                    'is_stock' => $pair->is_stock,
                    'market_status' => $pair->market_status,
                    'rate' => number_format($pair->rate, $precision, '.', ''),
                    'rate_sell' => number_format($pair->rate_sell, $precision, '.', ''),
                    'rateNoFormat' => $pair->rate,
                    'rateSellNoFormat' => $pair->rate_sell,
                    'symbol' => $pair->toCurrency->symbol,
                    'fromSymbol' => $pair->fromCurrency->symbol,
                    'buy_volume_limit' => $pair->buy_volume_limit,
                    'sell_volume_limit' => $pair->sell_volume_limit,
                    'pairId' => $pair->fromCurrency->acronym . $pair->toCurrency->acronym,
                    'buy_volume_limit_formatted' => Number::shortNumberFormatLimits($pair->buy_volume_limit),
                    'sell_volume_limit_formatted' => Number::shortNumberFormatLimits($pair->sell_volume_limit),
                    'buy_limit_left' => round($pair->buy_volume_limit - $todaysTradesValues['buy']),
                    'sell_limit_left' => round($pair->sell_volume_limit - $todaysTradesValues['sell']),
                    'buy_limit_left_formatted' => Number::shortNumberFormatLimits(round($pair->buy_volume_limit - $todaysTradesValues['buy'])),
                    'sell_limit_left_formatted' => Number::shortNumberFormatLimits(round($pair->sell_volume_limit - $todaysTradesValues['sell'])),
                ]; 

 

                if($data['buy_limit_left'] < 0)
                {

                    $data['buy_limit_left'] = 0;

                }

                if($data['sell_limit_left'] < 0)
                {

                    $data['sell_limit_left'] = 0;

                }

                $data['buy_limit_percent'] = $data['buy_volume_limit'] !== 0 ? $data['buy_limit_left'] / $data['buy_volume_limit'] * 100 : 0;
                $data['sell_limit_percent'] = $data['sell_volume_limit'] !== 0 ? $data['sell_limit_left'] / $data['sell_volume_limit'] * 100 : 0;
                $results[] = $data;

            }

        }

        return $results;

    }

    public function prepareCurrenciesAcronymsForCurlRequest($acronyms)
    {

        $fSyms = '';

        foreach($acronyms as $acronym)
        {

            $fSyms .= $acronym.',';

        }
        
        $fSyms = substr($fSyms, 0, -1);
        
        return $fSyms;

    }

    public function prepareCurrencyForDisplay($currency)
    {

        $cryptoCurrency = Currency::getClass($currency->acronym); 
        $precision = $cryptoCurrency->precisionIn('USD'); 
         
        return [
            'id' => $currency->id,
            'usd_value_raw' => $currency->usd_value,
            'name' => $currency->name,
            'acronym' => $currency->acronym,
            'symbol' => $currency->symbol,
            'description' => $currency->description,
            'full_description' => $currency->full_description,
            'meta_title' => $currency->meta_title,
            'meta_description' => $currency->meta_description,
            'seo_title' => $currency->seo_title,
            'seo_description' => $currency->seo_description,
            'asset_description' => $currency->asset_description,
            'links' => $currency->links ? json_decode($currency->links, true) : null,
            'usd_value' => number_format($currency->usd_value, $precision, '.', ''),
            
        ];        

    }

}