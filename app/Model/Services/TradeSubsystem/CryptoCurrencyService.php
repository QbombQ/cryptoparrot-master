<?php

namespace App\Model\Services\TradeSubsystem;

date_default_timezone_set('UTC');

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CryptoCurrencyServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\CryptoCurrencyFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\CurrencyFormatterInterface;
use App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\CurrencyRepositoryInterface;
use Carbon\Carbon;
use Cache;
use Log;
use Currency;
use Illuminate\Support\Facades\Redis;

class CryptoCurrencyService implements CryptoCurrencyServiceInterface
{

    protected $tradePairRepository;
    protected $cryptoCurrencyFormatter;
    protected $currencyRepository;
    protected $currencyFormatter;

    const GRAPH_START_DAYS_AGO = 0;
    const GRAPH_CACHE_LASTS_IN_HOURS = 1;

    public function __construct(
        TradePairRepositoryInterface $tradePairRepository,
        CryptoCurrencyFormatterInterface $cryptoCurrencyFormatter,
        CurrencyRepositoryInterface $currencyRepository,
        CurrencyFormatterInterface $currencyFormatter
    )
    {

        $this->tradePairRepository = $tradePairRepository;
        $this->cryptoCurrencyFormatter = $cryptoCurrencyFormatter;
        $this->currencyRepository = $currencyRepository;
        $this->currencyFormatter = $currencyFormatter;

    }

    public function getMarkets()
    {

        $results = [];
        $tradePairs = $this->tradePairRepository->getForCurrenciesPage();
        $redis = Redis::connection('external-redis');

        

        if($tradePairs->count() > 0){

            foreach($tradePairs as $key=>$pair)
            {

                if($pair->is_stock) $symbol = $pair->fromCurrency->acronym;
                else $symbol = $pair->fromCurrency->acronym.$pair->toCurrency->acronym;

                $stat = $redis->get('symbol:stat:'.$symbol);
                $candles = $redis->get('symbol:lastcandles:'.$symbol);
                $results[$key]['pair'] = $pair;  
                $results[$key]['candles'] = json_decode($candles); 
                $results[$key]['stat'] = json_decode($candles); 

            }

        }

        return $results;

    }

    public function getCryptocurrencies()
    {

        $top = $this->currencyRepository->getTopTenByMarketCap();
        dd($top);

    }


    public function updateGraphData()
    {

        try {

        $tradePairs = $this->tradePairRepository->getForCurrenciesPage();
        $results = [];

        if(env('APP_FORK') != 'fxparrot'){
            if($tradePairs->count() > 0)
            {

                $start = Carbon::now()->subDays(self::GRAPH_START_DAYS_AGO)->toDateString();

                foreach($tradePairs as $pair)
                {

                    $pairSymbol = $this->cryptoCurrencyFormatter->preparePairSymbolForPaprica($pair);
                    $pairSymbolForArray = $this->cryptoCurrencyFormatter->preparePairSymbolForCcxt($pair);
                    $papricaSymbol = config('custom.paprica')[$pairSymbol];
                    
                    $client = new \GuzzleHttp\Client();

                    try {

                        $request = $client->get('https://api.coinpaprika.com/v1/tickers/'.$papricaSymbol.'/historical?start='.$start.'&interval=1h&limit=168');
                        $response = json_decode($request->getBody()->getContents(), true);


                    }catch(\Exception $e)
                    {

                        Log::error($e);
                        $response = [];

                    }

                    $results[$pairSymbolForArray] = $this->cryptoCurrencyFormatter->prepareCryptoCurrencyForDisplay($pair, $response, $papricaSymbol);

                    sleep(1);

                }

            } 
        }  

        $expiresAt = Carbon::now()->addHours(self::GRAPH_CACHE_LASTS_IN_HOURS);
        Cache::put('graph-data', $results, $expiresAt);

        return $results;

        }catch(\Exception $e)
        {
            Log::error("CRYPTOCURRENCIES");
            Log::error($e);
        }

    }

    public function getGraphData()
    { 

        if(!Cache::has('graph-data'))
        {

            return $this->updateGraphData();

        }
         
        $graphData = Cache::get('graph-data');

        if(count($graphData) > 0)
        {

            foreach($graphData as $key => $item)
            {

                $currency = $this->currencyRepository->getByAcronym($item['currencyData']['acronym']);

                if($currency)
                {

                    $cryptoCurrency = Currency::getClass($currency->acronym);
                    $precision = $cryptoCurrency->precisionIn('USD');
                    $item['currencyData']['usd_value'] = number_format($currency->usd_value, $precision, '.', ',');
                    $graphData[$key] = $item;

                }

            }

        }      

        return $graphData;

    } 

    public function getCryptoCurrencyData($acronym)
    {

        $currency = $this->currencyRepository->getByAcronym($acronym);

        if(!$currency || !$currency->primary_pair) 
        {
            
            abort(404);

        }

        if(env('APP_FORK') == 'fxparrot') return $this->currencyFormatter->prepareCurrencyForDisplay($currency);  

        $pair = $this->tradePairRepository->getByIds($currency->id, $currency->primary_pair);

        if(!$pair) 
        {
            
            abort(404);

        }

        $pairSymbol = $this->cryptoCurrencyFormatter->preparePairSymbolForCcxt($pair);
        $graphData = $this->getGraphData();

        if(!array_key_exists($pairSymbol, $graphData)) 
        {
            
            abort(404);

        }


        return $graphData[$pairSymbol];

    }    

}