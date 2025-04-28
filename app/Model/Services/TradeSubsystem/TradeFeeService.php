<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeFeeServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeFeeFormatterInterface;
use App\Model\Contracts\Interfaces\Data\TradeFeeRepositoryInterface;
use Currency;

class TradeFeeService implements TradeFeeServiceInterface
{

    protected $tradeFeeRepository;
    protected $tradeFeeFormatter;

    public function __construct(
        TradeFeeRepositoryInterface $tradeFeeRepository,
        TradeFeeFormatterInterface $tradeFeeFormatter
    )
    {

        $this->tradeFeeRepository = $tradeFeeRepository;
        $this->tradeFeeFormatter = $tradeFeeFormatter;

    }

    public function calculateFee($trade)
    {

        if($trade->tradeFee)
        {

            return $trade->tradeFee->fee;

        }

        if($trade->market == 1)
        {

            $fee = config('custom.trade_fee_market');

        }else if($trade->stop == 1)
        {

            $fee = config('custom.trade_fee_stop');

        }else{

            $fee = config('custom.trade_fee_limit');

        }

        if($trade->leverage > 0)
        {

            $rate = $trade->tradePair->rate_sell;

            if($trade->type === 'buy' || $trade->type === 'long')
            {

                $rate = $trade->tradePair->rate;

            }

            $tradeValue = $trade->amount * $rate * $trade->leverage;
            $currencyId = Currency::dollar()->id;

        }else{

            if($trade->type == 'buy')
            {

                $tradeValue = $trade->amount;
                $currencyId = $trade->tradePair->fromCurrency->id;

            }else{

                $tradeValue = $trade->amount * $trade->tradePair->rate_sell;
                $currencyId = $trade->tradePair->toCurrency->id;

            }

        }

        return $tradeValue * $fee;

    }

    public function getFeeCurrency($trade)
    {

        if($trade->tradeFee)
        {

            return $trade->tradeFee->currency;

        }

        if($trade->leverage > 0)
        {

            return Currency::dollar();

        }else{

            if($trade->type == 'buy')
            {

                return $trade->tradePair->fromCurrency;

            }else{

                return $trade->tradePair->toCurrency;

            }

        }

    }

    public function getFeeInUsd($trade)
    {

        $fee = $this->calculateFee($trade);
        $currency = $this->getFeeCurrency($trade);

        return $fee * $currency->usd_value;

    }

    public function create($trade)
    {

        if($trade->market == 1)
        {

            $fee = config('custom.trade_fee_market');

        }else if($trade->stop == 1)
        {

            $fee = config('custom.trade_fee_stop');

        }else{

            $fee = config('custom.trade_fee_limit');

        }

        if($trade->leverage > 0)
        {

            $rate = $trade->tradePair->rate_sell;

            if($trade->type === 'buy' || $trade->type === 'long')
            {

                $rate = $trade->tradePair->rate;

            }

            $tradeValue = $trade->amount * $rate * $trade->leverage;
            $currencyId = Currency::dollar()->id;

        }else{

            if($trade->type == 'buy')
            {

                $tradeValue = $trade->amount;
                $currencyId = $trade->tradePair->fromCurrency->id;

            }else{

                $tradeValue = $trade->amount * $trade->tradePair->rate_sell;
                $currencyId = $trade->tradePair->toCurrency->id;

            }

        }

        $this->tradeFeeRepository->create(
            $this->tradeFeeFormatter->prepareForCreate($trade->id, $tradeValue * $fee, $currencyId)
        ); 

    }

    public function deleteTradeFees($tradeId)
    {

        $this->tradeFeeRepository->deleteTradeFees($tradeId);

    }

}