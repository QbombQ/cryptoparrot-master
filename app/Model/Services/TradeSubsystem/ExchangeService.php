<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\ExchangeServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\CurlServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\ExchangeFormatterInterface;
use App\Model\Contracts\Interfaces\Data\ExchangeRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\RewardServiceInterface;
use App\Model\Contracts\Interfaces\Validators\Common\ExchangeValidatorInterface;
use App\Mail\UserMadeRewardExchange;
use Illuminate\Support\Facades\Mail;
use Currency;
use Cache;
use Auth;

class ExchangeService implements ExchangeServiceInterface
{

    protected $exchangeValidator;
    protected $exchangeFormatter;
    protected $exchangeRepository;
    protected $balanceService;
    protected $curlService;
    protected $userRepository;
    protected $rewardService;

    public function __construct(
        ExchangeValidatorInterface $exchangeValidator,
        ExchangeFormatterInterface $exchangeFormatter,
        ExchangeRepositoryInterface $exchangeRepository,
        BalanceServiceInterface $balanceService,
        CurlServiceInterface $curlService,
        UserRepositoryInterface $userRepository,
        RewardServiceInterface $rewardService
    )
    {

        $this->exchangeRepository = $exchangeRepository;
        $this->exchangeFormatter = $exchangeFormatter;
        $this->exchangeValidator = $exchangeValidator;
        $this->balanceService = $balanceService;
        $this->curlService = $curlService;
        $this->userRepository = $userRepository;
        $this->rewardService = $rewardService;

    }
 

    public function paginate($perPage)
    {

        return $this->exchangeFormatter->prepareExchangesForDisplay(
            $this->exchangeRepository->paginate($perPage)
        );

    }

    public function getUserExchanges($userId)
    {

        return $this->exchangeFormatter->prepareExchangeHistoryForDisplay(
            $this->exchangeRepository->getUserExchangeHistory($userId)
        );

    }

    public function get()
    {

        $rates = config('custom.exchange_rates');

        return $rates;

    }

    public function exchange($user, $data)
    {

        $data['user_id'] = $user->id; 
        $btcRate = Cache::get('btc-rate-for-redeem-'.Auth::user()->id);

        if(!$this->exchangeValidator->validateCreation($data,$user,$btcRate))
        {

            return $this->exchangeFormatter->prepareCreationFailResponse($this->exchangeValidator->getErrors()->errors()->first());

        }  
  
        $data['invoice_address'] = $this->exchangeFormatter->parseLightningAddress($data['invoice_address']);
        $this->balanceService->addAmount($user->id, Currency::dollar()->id, $user->main_portfolio_id, $data['amount']*-1);

        $satoshiToUsd = $btcRate / 100000000;
        $perK = Currency::getUsdRate($this->rewardService->eligibleAmount(Auth::user()));
        $satsPerK = round($perK / $satoshiToUsd,0);

        $amountRounded = ($data['amount'] - ($data['amount'] % 1000));
        $thousands = (int) $amountRounded / 1000;  

        $cryptoChillResponse = $this->cryptoChillExchange($data['invoice_address'], $thousands * $satsPerK, $data['amount']);


        if($cryptoChillResponse == false)
        {

            $this->balanceService->addAmount($user->id, Currency::dollar()->id, $user->main_portfolio_id, $data['amount']); //return if failed
            return $this->exchangeFormatter->prepareCreationFailResponse(trans('TradeSubsystem/error-messages.something-went-wrong'));

        }else if($cryptoChillResponse !== true){


            $this->balanceService->addAmount($user->id, Currency::dollar()->id, $user->main_portfolio_id, $data['amount']); //return if failed
            return $this->exchangeFormatter->prepareCreationFailResponse($cryptoChillResponse);
 
        }

        return [
            'success' => true
        ];

    }   

    public function requestSuccess($data, $user)
    {

        \Log::error($data);
        \Log::error($user); 

        $this->exchangeRepository->create(
            $this->exchangeFormatter->prepareForCreate($data, $user)
        );

        //$this->balanceService->addAmount($user->id, Currency::dollar()->id, $user->main_portfolio_id, $data['amount']*-1);
        $user->earn_play_dollars_reward_diff -= $data['amount_play_dollars'];
        $user->save();

        Mail::to($user)->send(new UserMadeRewardExchange($data,$user));

    }  
 
    public function requestFailed($data, $user)
    {
 
        $this->balanceService->addAmount($user->id, Currency::dollar()->id, $user->main_portfolio_id, $data['amount_play_dollars']); //return if failed
        $this->exchangeRepository->create(
            $this->exchangeFormatter->prepareForCreateFailed($data, $user)
        );

    } 

    public function cryptoChillExchange($invoiceAddress, $amount, $amountUsd)
    {
        
        $response = $this->curlService->cryptoChillRequest(
            'payouts',
            $this->exchangeFormatter->preparePayloadForRequest($invoiceAddress, $amount, $amountUsd),
            'POST'
        );

        return $response; 

    }
    
    public function exchangeCallback($request)
    {

        \Log::info($request->all());
 
        if($request->callback_status == 'payout_complete'){
        
            $pass = json_decode($request->payout['passthrough'], true);

            $user = $this->userRepository->get($pass['user_id']);

            if(!$user)
            {

                return;

            }

            $data = $this->exchangeFormatter->prepareCallbackForFinish($pass);

            if($request->callback_status == 'payout_complete')
            {

                $this->requestSuccess($data, $user);

            }else{

                $this->requestFailed($data, $user);

            }

        } 

    }

}