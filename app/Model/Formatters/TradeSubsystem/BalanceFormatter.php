<?php 

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\BalanceFormatterInterface;
use Number;
use Currency;

class BalanceFormatter implements BalanceFormatterInterface
{

    public function prepareUserBalancesForPortfolioDisplay($balances)
    {

        $results = [];

        if($balances->count() > 0)
        {

            foreach($balances as $balance)
            {

                if($balance->reserved_amount < 0.0001 && $balance->amount < 0.0001)
                {

                    continue;

                }

                $name = $this->getPortfolioLabel($balance);
                $symbol = $balance->currency->symbol;
                $cryptoCurrency = Currency::getClass($balance->currency->acronym);
                $precision = $cryptoCurrency->getDefaultPrecision();

                if($precision == 0)
                {

                    $amount = Number::numberFormatPrecision($balance->amount-$balance->reserved_amount, $precision);
                    $reservedAmount = Number::numberFormatPrecision($balance->reserved_amount, $precision);

                } else {

                    $amount = Number::numberFormatPrecision($balance->amount-$balance->reserved_amount, $precision);
                    $reservedAmount = Number::numberFormatPrecision($balance->reserved_amount, $precision, '.');
                    $amount = preg_replace("/[0]+$/", '<span class="ending-zeroes">${0}</span>', $amount);
                    $reservedAmount = preg_replace("/[0]+$/", '<span class="ending-zeroes">${0}</span>', $reservedAmount);

                }

                $results[] = [
                    'name' => $name,
                    'symbol' => $symbol,
                    'acronym' => $balance->currency->acronym,
                    'overallAmount' => $symbol === '$' ? $balance->amount-$balance->reserved_amount - $balance->user->earn_play_dollars_reward_diff : null,
                    'amount' => $amount,
                    'reserved' => $reservedAmount,
                    'percents' => $balance->portfolio->portfolio_value_in_usd > 0 ? number_format($balance->usd_value / $balance->portfolio->portfolio_value_in_usd * 100, 1) : 0,
                ];
               
            }

        }

        return $results;

    }

    public function calculateBalancesSumInUSD($balances)
    {

        $sum = $balances->sum('usd_value');   

        return Number::addSign($sum) . Number::shortNumberFormat(abs($sum));

    }

    public function calculateBalancesSumInUSDChangeFromStart($balances)
    {

        $newestBalance = $balances->first();

        if($newestBalance)
        {

            $sum = $balances->sum('usd_value') - $newestBalance->user->mainPortfolio->starting_portfolio_value_in_usd;

        } else {

            $sum = $balances->sum('usd_value');

        }
        
        return Number::numberSign($sum) . Number::shortNumberFormat(abs($sum));       

    }

    private function getPortfolioLabel($balance)
    {

        switch($balance->currency->acronym)
        {
            case 'USD':
                return 'Play USD';
            default:
                return $balance->currency->name;
        }

    }

}