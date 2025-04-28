<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use App;
use Currency;
use Cache;

class CorrectExchangeAmount implements Rule
{

    protected $invoiceAddress;
    protected $btcRate;
    protected $validAddress;
    protected $rewardService;

    public function __construct($invoiceAddress,$btcRate)
    {

        $this->rewardService = \App::make('App\Model\Contracts\Interfaces\Services\TradeSubsystem\RewardServiceInterface');
        $this->invoiceAddress = $invoiceAddress;
        $this->btcRate = $btcRate;
        $this->validAddress = true;
        

    } 
 
    public function passes($attribute, $value)
    {

        if($this->invoiceAddress == null)
        {
        
            return true;
        
        }

        if(!$this->btcRate) return false;

        $parsedAddress = str_replace('lightning:', '', $this->invoiceAddress);
        $multipliers = [
			'u' => 0.000001,
			'm' => 0.001,
			'n' => 0.000000001,
			'p' => 0.000000000001
		];
		$regex = '/lnbc([0-9]+)0(m|u|n|p).+/m';
        preg_match_all($regex, $parsedAddress, $matches, PREG_SET_ORDER, 0);

		if(count($matches) === 0 || count($matches[0]) !== 3)
		{

            $this->validAddress = false;
            return false;

		}

		$invoiceAmountSats = $matches[0][1];

        $amountLeftNoFormat = $this->rewardService->eligibleAmount(Auth::user());
        $satoshiToUsd = $this->btcRate / 100000000;
        $perK = Currency::getUsdRate($amountLeftNoFormat);
        $satsPerK = round($perK / $satoshiToUsd,0);
        $thousands = $value / 1000;  

        $redeemAmountSats = $thousands * $satsPerK;

        if((int) $redeemAmountSats !== (int) $invoiceAmountSats)
        {
      
            return false;

        }

        return true;

    }

    public function message()
    {

        if($this->validAddress)
        {

            return trans('TradeSubsystem/error-messages.incorrect-amount');

        }else{

            return trans('TradeSubsystem/error-messages.invalid-invoice-address');

        }
        
    }
}
