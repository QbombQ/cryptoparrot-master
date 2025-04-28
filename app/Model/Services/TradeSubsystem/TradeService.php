<?php 

namespace App\Model\Services\TradeSubsystem;

use App;
use App\Jobs\UpdateTrades;
use App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\TradeRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\TradeVoteRepositoryInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\HtmlParserServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\PortfolioServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeConditionServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeFeeServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Validators\Common\TradeValidatorInterface;
use Currency;
use Log;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TradeService implements TradeServiceInterface
{

    protected $tradeFormatter;
    protected $tradeValidator;
    protected $tradeRepository;
    protected $fileService;
    protected $balanceService;
    protected $htmlParserService;
    protected $tradePairRepository;
    protected $tradeConditionService;
    protected $tradeFeeService;
    protected $portfolioService;
    protected $tradeVoteRepository;

    public function __construct(TradeFormatterInterface $tradeFormatter,
                                TradeValidatorInterface $tradeValidator,
                                BalanceServiceInterface $balanceService,
                                FileServiceInterface $fileService,
                                HtmlParserServiceInterface $htmlParserService,
                                TradePairRepositoryInterface $tradePairRepository,
                                TradeConditionServiceInterface $tradeConditionService,
                                TradeFeeServiceInterface $tradeFeeService,
                                PortfolioServiceInterface $portfolioService,
                                TradeVoteRepositoryInterface $tradeVoteRepository,
								TradeRepositoryInterface $tradeRepository) 
	{

        $this->tradeFormatter = $tradeFormatter;
        $this->tradeValidator = $tradeValidator;
        $this->tradeRepository = $tradeRepository;
        $this->fileService = $fileService;
        $this->balanceService = $balanceService;
        $this->htmlParserService = $htmlParserService;
        $this->tradePairRepository = $tradePairRepository;
        $this->tradeConditionService = $tradeConditionService;
        $this->tradeFeeService = $tradeFeeService;
        $this->portfolioService = $portfolioService;
        $this->tradeVoteRepository = $tradeVoteRepository;

    }	

    public function limitExceeded($data)
    {

        if(!$this->tradeValidator->validateLimit($data)) 
        {

            return [
                'success' => false,
                'errors' => $this->tradeValidator->getErrors()->errors()
            ];

        }

        return [
            'success' => true
        ];

    }

    public function getTradesWithDescriptionLongerThan($length, $currencyId)
    {

        $trades = $this->tradeRepository->getTradesWithDescriptionLongerThan($length, $currencyId, Auth::check() ? Auth::user()->id : null);

        return $this->tradeFormatter->prepareTradesForFeedPage($trades);

    }

    public function getTodayTradesValue($userId, $pair, $portfolioId)
    {

        $todayTrades = $this->tradeRepository->getTodayTradesByPair($userId, $pair, $portfolioId); 
   
        $values = [
            'buy' => 0,
            'sell' => 0
        ];

        if($todayTrades->count() > 0)
        {

            foreach($todayTrades as $trade)
            {

                if($trade->type === 'buy' || $trade->type === 'long')
                {

                    $values['buy'] += $trade->amount;

                } else {

                    $values['sell'] += $trade->amount;

                }

            }

        }

        return $values;
            
    }

    public function getTrades($limit, $user, $userOnly = false, $timestamp, $myFeed = false)
    {

        if(!$userOnly)
        {

            $followings = $user->followings->pluck('following_id')->toArray();

        } else {

            $followings = [];

        }

        $blockedUsers = $user->blockedUsers->pluck('blocked_user_id')->toArray();
        $blockedBy = $user->blockedByUsers->pluck('blocked_by')->toArray();
        $blackList = array_merge($blockedUsers, $blockedBy);

        if($myFeed)
        {

            $trades = $this->tradeRepository->getUserTradesPrivateFeed($user->id, $followings, $limit, $timestamp, $blackList);

        } else {

            $trades = $this->tradeRepository->getUserTradesFeed($user->id, $followings, $limit, $timestamp, $blackList);

        }

        return $trades ? $this->tradeFormatter->prepareTradesForFeedPage($trades) : [];

    }

    private function prepareRequestForMarket($request)
    {

        $tradePair = $this->tradePairRepository->get($request->trade_pair_id);

        $request->price = $request->type == 'buy' || $request->type == 'long' ? $tradePair->rate : $tradePair->rate_sell;

        if($request->type == 'buy' || $request->type == 'long')
        {

            $request->amount = $request->total / $tradePair->rate;

        } else {
            $request->amount = $request->total;

        }
    
        if($request->leverage !== 0)
        {

            $request->status = 'open';
            $request->open_price = $request->price;

        }

        return $request;

    }

    private function reserveLeverageBalance($request, $tradePair)
    {

        if($request->type == 'buy')
        {

            $this->balanceService->reserve(Auth::id(), $tradePair->to_currency_id, $request->portfolio_id, $request->amount * $request->price);

            return $request->amount * $request->price;
        
        } else { 

            $this->balanceService->reserve(Auth::id(), $tradePair->from_currency_id, $request->portfolio_id, $request->amount);

            return $request->amount;
        
        }   

    }
      
    public function createTrade($request)
    {
        
        if(!$this->tradeValidator->validateCreation($request->all())) 
        {

            return [
                'success' => false,
                'creation_error' => true,
                'errors' => $this->tradeValidator->getErrors()->errors()
            ];

        }
        
        $portfolio = $this->portfolioService->get($request->portfolio_id);

        if(!Gate::allows('use-portfolio', $portfolio)) 
        {
        
            return [
                'success' => false,
                'errors' => $this->tradeValidator->getErrors()->errors()
            ];
        
        }

        $tradePair = $this->tradePairRepository->get($request->trade_pair_id);

        $this->balanceService->createIfDoesNotExist(Auth::id(), $tradePair->from_currency_id, $request->portfolio_id);
        
        if($request->market && $request->market == 'on')
        {

            $request = $this->prepareRequestForMarket($request);

        }
        
        if($request->leverage == 0)
        {

            $request->merge(['reserved_sum' => $this->reserveLeverageBalance($request, $tradePair)]);

        } else {

            $this->balanceService->reserve(Auth::id(), Currency::dollar()->id, $request->portfolio_id, $request->amount * $request->price);
            $request->merge(['reserved_sum' => $request->amount * $request->price]);

        }
        
        $tradeId = $this->tradeRepository->create(
            $this->tradeFormatter->prepareRequestForTradeCreation($request)
        );

        $request->merge(['trade_id' => $tradeId]);
        $this->tradeConditionService->create($request->all());
        $this->fileService->uploadTechnicalAnalysis($request, $tradeId);

        return [
            'success' => true,
            'message' => trans('TradeSubsystem/success-messages.trade-created')
        ];

    }

    public function update($user, $data)
    {

        $trade = $this->tradeRepository->getById($data['trade_id']);

        if(!$trade)
        {

            return $this->tradeFormatter->prepareUpdateFailResponse('Trade does not exist!');

        }

        if($trade->user_id !== $user->id)
        {

            return $this->tradeFormatter->prepareUpdateFailResponse('Its not your trade!');

        }

        if(!$this->tradeValidator->validateUpdate($data, $trade))
        {

            return $this->tradeFormatter->prepareUpdateFailResponse($this->tradeValidator->getErrors()->errors()->first());

        }

        $this->tradeConditionService->update($this->tradeFormatter->prepareTradeForConditionUpdate($data));

        return $this->tradeFormatter->prepareUpdateSuccessResponse('Trade updated!');

    }

    public function getActiveTrades($portfolioId,$tradeType)
    { 

        $trades = $this->tradeRepository->getUserActiveTrades($portfolioId,$tradeType);

        return $this->tradeFormatter->prepareActiveTradesForDisplay($trades);

    }

    public function cancelTrade($tradeId, $kernel = false)
    {
 
        $trade = $this->tradeRepository->getById($tradeId);

        if(!$kernel)
        {

            if(!$trade || !Gate::allows('cancel-trade', $trade))
            {
                
                return false;

            }

        }

        if($trade->status == 'active')
        {

            $this->tradeRepository->cancel($tradeId);

            if($trade->type == 'buy')
            {

                $this->balanceService->release(
                    $trade->user_id,
                    $trade->tradePair->to_currency_id,
                    $trade->portfolio_id,
                    $trade->amount * $trade->target_price
                );

            }else if($trade->type == 'sell')
            {

                $this->balanceService->release(               
                    $trade->user_id,
                    $trade->tradePair->from_currency_id,
                    $trade->portfolio_id,
                    $trade->amount
                );

            } else {

                $this->balanceService->release(
                    $trade->user_id,
                    Currency::dollar()->id,
                    $trade->portfolio_id,
                    $trade->amount / $trade->leverage * $trade->target_price
                );

            }

        }  

        return true;

    }

    public function getUserTrade($userId, $tradeId)
    {

        $trade = $this->tradeRepository->getById($tradeId);

        if(!$trade || $trade->author->id !== $userId) 
        {
            
            abort(404);

        }

        return $this->tradeFormatter->prepareTradesForFeedPage(collect([$trade]))['data'][0];

    }

    public function getUserTrades($userId)
    {

        $trades = $this->tradeRepository->getUserTrades($userId);

        return $this->tradeFormatter->prepareTradesForFeedPage($trades);

    }

    public function getSourceMetadata($request)
    {

        if(!$this->tradeValidator->validateSource($request->all()))
        {

            return $this->tradeFormatter->prepareSourceMetadataResponseWithErrors($this->tradeValidator->getErrors()->errors());

        }

        $data = $this->htmlParserService->getSourceMetadata($request);
        
        return $this->tradeFormatter->prepareSourceMetadataResponse($data);

    }

    private function exceededDailyLimit($trade)
    {

        $totalValue = $trade->amount;
        $totalTradesValuesToday = $this->getTodayTradesValue($trade->user_id, $trade->tradePair, $trade->portfolio_id);

        if($trade->type === 'buy' || $trade->type === 'long') {

            return $totalValue > ($trade->tradePair->buy_volume_limit - $totalTradesValuesToday['buy']);

        } else {

            return $totalValue > ($trade->tradePair->sell_volume_limit - $totalTradesValuesToday['sell']);

        }

    }
    
    public function closeTrade($id, $kernel = false)
    {

        $trade = $this->tradeRepository->getById($id);
        $dollarCurrency = Currency::dollar();

        if(!$kernel)
        {

            if(!$trade || !Gate::allows('cancel-trade', $trade)) 
            {
                
                return false;

            }

            if($this->exceededDailyLimit($trade)) 
            {
                
                return trans('TradeSubsystem/error-messages.exceeded-daily-limit');

            }

        }

        if($trade->status == 'open')
        { 
        
            $initialValue = $trade->amount * $trade->target_price;
            $priceWhenClosed = 0;
            $profit = 0;

            $income = $trade->amount * $trade->tradePair->fromCurrency->usd_value;
            $priceWhenClosed = $trade->tradePair->fromCurrency->usd_value;
            $amountToRelease = ($trade->amount / $trade->leverage) * $trade->target_price;

            if($trade->type == 'long')
            {

                $profit = $income - $initialValue;

            } else {
  
                $profit = $initialValue - $income;

            } 

            $profit -= $trade->tradeFee ? $trade->tradeFee->fee : 0;

            if($trade->tradeFee){

                Log::error('closed postiion fee:'.$trade->tradeFee->fee); 

            }else{

                Log::error('closed postiion no fee'); 

            } 

            $this->balanceService->release(
                $trade->user_id,
                $dollarCurrency->id,
                $trade->portfolio_id,
                $amountToRelease
            );

            $this->balanceService->addAmount($trade->user_id, $dollarCurrency->id, $trade->portfolio_id, $profit);

            $this->balanceService->updateUsdValues($trade->author->handle);
            $this->tradeRepository->update(
                $trade->id,
                [
                    'target_price' => $priceWhenClosed,
                    'profit' => $profit,
                    'reserved_sum' => $trade->reserved_sum - $amountToRelease
                ]
            );
            $this->tradeRepository->finish($id);

        }

        return "SUCCESS";        

    }

    public function updateTradeVisibility($data)
    {

        if(!array_key_exists('trade_id', $data))
        {

            return ['success' => false, 'message' => 'no trade id'];

        }

        $trade = $this->tradeRepository->getById($data['trade_id']);

        if(!$trade || !Gate::allows('cancel-trade', $trade)) 
        {
            
            return ['success' => false, 'message' => 'do not have a right'];

        }
        
        $this->tradeRepository->update($trade->id, $this->tradeFormatter->prepareDataForVisibilityUpdate($data));

        return ['success' => true, 'message' => 'Updated'];

    }

    public function calculateTradeProfit($trade)
    {

        $initialValue = $trade->amount * $trade->target_price;

        if($trade->type == 'long')
        {

            $income = $trade->amount * $trade->tradePair->fromCurrency->usd_value;
            $profit = $income - $initialValue;

        } else {

            $income = $trade->amount * $trade->tradePair->fromCurrency->usd_value;
            $profit = $initialValue - $income;

        }
        
        return $profit;
    }

    public function getMyTrades($portfolioId)
    {

        $trades = $this->tradeRepository->getPortfolioTrades($portfolioId);

        return $this->tradeFormatter->prepareActiveTradesForTableDisplay($trades);

    }

    public function checkIfFirstTradeWithThisCrypto($trade)
    {

        $similarTrades = $this->tradeRepository->getSameCurrencyTrades($trade->author->id, $trade->trade_pair_id);

        return $similarTrades->count() < 2;

    }

    public function checkIfThreeTrades($trade)
    {

        $similarTrades = $this->tradeRepository->getSameCurrencyTrades($trade->author->id, $trade->trade_pair_id);

        return $similarTrades->count() == 3;

    }

    public function loadTrade($tradeId, $user, $commonUserData)
    {

        $trade = $this->tradeRepository->getById($tradeId);

        if(!$trade)
        {

            return [
                'success' => false
            ];

        }

        $followers = $trade->author->followers;

        $follower = $followers->firstWhere('follower_id', $user->id);

        $tradeHtml = view('pages/TradeSubsystem/common/trade',
            [
                'trade' => $this->tradeFormatter->prepareTradesForFeedPage(collect([$trade]), $user)['data'][0],
                'location' => geoip(request()->ip()),
                'commonUserData' => $commonUserData,
                'socket' => true
            ]
        )->render();

        return [
            'success' => true,
            'html' => $tradeHtml,
            'myFeed' => $follower && $user->id !== Auth::id()
        ];

    }

    public function archiveTrades($userId)
    {

        $this->tradeRepository->archiveUserTrades($userId);

    }

    public function updateTrades($fromId, $toId)
    {

        UpdateTrades::dispatch($fromId, $toId)->onQueue(env('PREFIX').'-low');

    }

    public function voteUpTrade($userId, $tradeId)
    {

        if(!$this->tradeVoteRepository->voted($userId, $tradeId))
        {

            $this->tradeVoteRepository->vote($userId, $tradeId);
            $this->tradeRepository->voteUp($tradeId);

        }

    }

    public function voteDownTrade($userId, $tradeId)
    {

        if($this->tradeVoteRepository->voted($userId, $tradeId))
        {

            $this->tradeVoteRepository->delete($userId, $tradeId);
            $this->tradeRepository->voteDown($tradeId);
            
        }

    }

}