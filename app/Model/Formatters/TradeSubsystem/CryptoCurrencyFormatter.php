<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\CryptoCurrencyFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\CurrencyFormatterInterface;
use Currency;

class CryptoCurrencyFormatter implements CryptoCurrencyFormatterInterface
{

    protected $currencyFormatter;

    public function __construct(
        CurrencyFormatterInterface $currencyFormatter
    )
    {

        $this->currencyFormatter = $currencyFormatter;

    }

    public function preparePairSymbolForCcxt($pair)
    {
        
        $fromAcronym = $pair->fromCurrency->acronym;
        $toAcronym = $pair->toCurrency->acronym;

        if($fromAcronym == 'DGB' && $toAcronym == 'USD')
        {
            
            $toAcronym = 'BTC'; //exception for DGB since DGBUSD in not available on coinmarketcap yet

        }

        if($fromAcronym == 'TUBE' && $toAcronym == 'USD')
        {
            
            $toAcronym = 'BTC'; //exception for DGB since DGBUSD in not available on coinmarketcap yet

        }

        return $fromAcronym . '/' . $toAcronym; 

    }

    public function preparePairSymbolForPaprica($pair)
    {
        
        $fromAcronym = $pair->fromCurrency->acronym;
        $toAcronym = $pair->toCurrency->acronym;

        if($fromAcronym === 'USD' || $toAcronym === 'USD')
        {

            return $fromAcronym === 'USD' ? $toAcronym : $fromAcronym; 

        }

        if($fromAcronym === 'BTC' || $toAcronym === 'BTC')
        {

            return $fromAcronym === 'BTC' ? $toAcronym : $fromAcronym; 

        }

        return $fromAcronym;

    }

    public function prepareCryptoCurrencyForDisplay($pair, $result, $papricaSymbol)
    {

        $cryptoCurrency = Currency::getClass($pair->fromCurrency->acronym);
        $precision = $cryptoCurrency->precisionIn('USD');
        $chart7Days = [];

        foreach($result as $item)
        {

            $chart7Days[] = $item['price'];

        }
 
        $pairSymbol = config('custom.paprica.'.$pair->fromCurrency->acronym);

        $cmc = new \Coinpaprika\Client();

        try {

            $cmcPair = $cmc->getTickerByCoinId($papricaSymbol);

        }catch(\Exception $e)
        {

            try {

                $cmcPair = $cmc->getTickerByCoinId($papricaSymbol);

            }catch(\Exception $e)
            {

                $cmcPair = null;

            }

        }

        return [ 
            'chart7Days' => $chart7Days,
            'currencyData' => $this->currencyFormatter->prepareCurrencyForDisplay($pair->fromCurrency),
            'pair' => $cmcPair
        ]; 

    }

}