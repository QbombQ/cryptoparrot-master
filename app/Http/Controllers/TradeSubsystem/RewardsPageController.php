<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\RewardServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CurrencyServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\ExchangeServiceInterface;
use Auth;
use Illuminate\Http\Request;
use Number;
use Currency;
use Carbon\Carbon;
use Cache;

class RewardsPageController extends BaseTradeSubsystemController
{

	protected $rewardService;
	protected $exchangeService;
    protected $currencyService;

	public function __construct(
        UserFormatterInterface $userFormatter,
        RewardServiceInterface $rewardService,
        CurrencyServiceInterface $currencyService,
        ExchangeServiceInterface $exchangeService
    ) 
	{

		parent::__construct($userFormatter);
		$this->rewardService = $rewardService;
		$this->exchangeService = $exchangeService;
        $this->currencyService = $currencyService;
		
	} 
	
    public function main()
    {

        parent::getCommonData();

        if(request()->segment(2) == 'rewards' && request()->segment(3) == 'page') 
        {

            $this->data['canonical'] = '/rewards';
            
        }

        $btc = $this->currencyService->getById(1); 

        $expiresAt = Carbon::now()->addHours(1);

        if(Auth::check()){
            Cache::put('btc-rate-for-redeem-'.Auth::user()->id, $btc['rate'], $expiresAt);
        }

        $this->data['exchanges'] = $this->exchangeService->paginate(10);  
        $this->data['amountLeftNoFormat'] = Auth::check() ? $this->rewardService->amountLeft(Auth::user()) : 0;
        $this->data['amountLeft'] = Auth::check() ? Number::niceNumber($this->data['amountLeftNoFormat']) : 0;
        $this->data['eligibleAmountLeftNoFormat'] = Auth::check() ? $this->rewardService->eligibleAmount(Auth::user()) : 0;

        $this->data['eligibleAmountLeftNoFormatRounded'] = Auth::check() ? ($this->data['amountLeftNoFormat'] - ($this->data['amountLeftNoFormat'] % 1000)) : 1000;
        $this->data['thousandsLeft'] = $this->data['eligibleAmountLeftNoFormatRounded'] / 1000;  

        $this->data['btcRate'] = $btc['rate'];  

        $satoshiToUsd = $btc['rate'] / 100000000;
        $perK = Currency::getUsdRate($this->data['eligibleAmountLeftNoFormat']);
        $satsPerK = round($perK / $satoshiToUsd,0);



        $this->data['usdEstimate'] = $perK * $this->data['thousandsLeft'];  
        

        $this->data['rewardPerThousand'] = $satsPerK; 


        $this->data['defaultUSDReward'] = $perK;  
        $this->data['defaultBTCReward'] = number_format($satsPerK / 100000000, 8);

        $this->data['btcEstimate'] = number_format($satsPerK * $this->data['thousandsLeft']/ 100000000, 8);  
    
        return view($this->viewWithPrefix('rewards'), $this->data);

    }

    public function myRewards()
    {

        parent::getCommonData();
        $this->data['rewards'] = $this->rewardService->myRewards(Auth::user());
        $this->data['exchanges'] = $this->exchangeService->getUserExchanges(Auth::id());
        $this->data['amountLeft'] = $this->rewardService->amountLeft(Auth::user());
        
        return view($this->viewWithPrefix('my-rewards'), $this->data);

    }

    public function buy($id, Request $request)
    {

        $request->merge([
            'reward_id' => $id,
            'user_id' => Auth::id()
        ]);

        return $this->rewardService->buy(Auth::user(), $request->all());

    }

}