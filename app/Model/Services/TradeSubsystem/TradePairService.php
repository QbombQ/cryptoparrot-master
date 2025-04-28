<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradePairServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradePairFormatterInterface;
use App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\CurrencyRepositoryInterface;
use Log;

class TradePairService implements TradePairServiceInterface
{

    protected $tradePairFormatter;
    protected $tradePairRepository;
    protected $currencyRepository;

    public function __construct(
        TradePairFormatterInterface $tradePairFormatter,
        TradePairRepositoryInterface $tradePairRepository,
        CurrencyRepositoryInterface $currencyRepository
    )
    {
        $this->tradePairFormatter = $tradePairFormatter;
        $this->tradePairRepository = $tradePairRepository;
        $this->currencyRepository = $currencyRepository;
    }

    public function getForFeedPage()
    {

        $pairs = $this->tradePairRepository->enabled();

        return $this->tradePairFormatter->prepareForFeedPage($pairs);

    } 


    public function getWeeklyChangeForEachPair()
    {

        $pairs = $this->tradePairRepository->enabled();
        $client = new \GuzzleHttp\Client();

        foreach($pairs as $pair){

            try 
            {

                $papricaSymbol = config('custom.paprica')[$pair->fromCurrency->acronym];
                $request = $client->get('https://api.coinpaprika.com/v1/tickers/'.$papricaSymbol.'/');
                $response = json_decode($request->getBody()->getContents(), true);

                $this->tradePairRepository->update(
                    $pair->id,
                    array(
                        'weekly_pct_change'=>$response['quotes']['USD']['percent_change_7d']
                    )
                );
             

            }catch(\Exception $e)
            {

                Log::error($e);

            }

            sleep(1);

        }

    }
 
} 