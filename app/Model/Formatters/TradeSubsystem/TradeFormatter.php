<?php 

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeCommentFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeFeeFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\BalanceFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeFeeServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\HtmlParserServiceInterface;
use App\Model\Contracts\Interfaces\Data\TradeVoteRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\TradeCommentRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
use Avatar;
use Dongm2ez\Mention\Mention;
use LaravelVideoEmbed;
use Pagination;
use Balance;
use Number;
use Strings;
use Media;
use Currency;
use Time;
use Log;

class TradeFormatter implements TradeFormatterInterface
{

    protected $balanceFormatter;
    protected $tradeVoteRepository;
    protected $tradeCommentFormatter;
    protected $tradeCommentRepository;
    protected $htmlParserService;
    protected $tradeFeeService;

    public function __construct(BalanceFormatterInterface $balanceFormatter,
                                TradeCommentRepositoryInterface $tradeCommentRepository,
                                TradeCommentFormatterInterface $tradeCommentFormatter,
                                HtmlParserServiceInterface $htmlParserService,
                                TradeFeeServiceInterface $tradeFeeService,
                                TradeVoteRepositoryInterface $tradeVoteRepository)
    {

        $this->balanceFormatter = $balanceFormatter;
        $this->tradeVoteRepository = $tradeVoteRepository;
        $this->tradeCommentFormatter = $tradeCommentFormatter;
        $this->tradeCommentRepository = $tradeCommentRepository;
        $this->htmlParserService = $htmlParserService;
        $this->tradeFeeService = $tradeFeeService;

    }    

    public function prepareSourceMetadataResponseWithErrors($errors)
    {

        return [
            'success' => false,
            'errors' => $errors
        ];

    }

    public function prepareSourceMetadataResponse($data)
    {

        $data['success'] = count($data) > 0 ? true : false;

        return $data;

    }


    private function getSourceData($request)
    {

        $data = [];

        if(!isset($request->analysis))
        {

            $request = Strings::extractLinkFromDescription($request);

        }

        if($request->source_type && $request->source_type === 'image')
        {

            $data = [
                'analysis_link' => Strings::sanitizeForUrl($request->analysis->getClientOriginalName()).'.jpg'
            ];

        } else if($request->source_type && $request->source_type === 'trading_view')
        {

            $code = Media::getTradingViewCode($request->trading_view);

            if($code)
            {
                
                $data = ['trading_view_code' => $code, 'trading_view_link' => $request->trading_view];

            }

        } else if($request->source_type && $request->source_type === 'video')
        {

            $data = [
                'video_link' => $request->video
            ];

        } else {

            if($request->source_type && $request->source_type == 'link')
            {

                $data = $this->htmlParserService->getSourceMetadata($request);

            }

        }

        return $data;

    }

    public function prepareTradeForConditionUpdate($data)
    {

        return [
            'below_limit' => $data['stop_loss'],
            'above_limit' => $data['take_profit'],
            'trade_id'    => $data['trade_id']
        ];

    }

    public function prepareUpdateFailResponse($message)
    {

        return [
            'success' => false,
            'message' => $message
        ];

    }

    public function prepareUpdateSuccessResponse($message)
    {

        return [
            'success' => true,
            'message' => $message
        ];

    }

    public function prepareRequestForTradeCreation($request)
    {

        $data = $this->getSourceData($request);
        $mention = new Mention;
        $parsedDescription = $mention->parse(strip_tags($request->description));
        $description = $parsedDescription ? $parsedDescription : strip_tags($request->description);
        $type = $request->type;

        if($request->leverage > 0)
        {

            $type = $type === 'sell' ? 'short' : 'long';

        }

        $amount = $request->amount;

        if($request->leverage > 0) 
        {
            
            $amount *= $request->leverage;

        }
        
        return [
            'status' => $request->status ? $request->status : 'active',
            'type' => $type,
            'amount' => $amount,
            'target_price' => $request->price,
            'start_price' => $request->price,
            'description' => $description ? $description : null,
            'source_type' => $request->source_type ? $request->source_type : null,
            'source' => json_encode($data),
            'public' => $request->public && $request->public == 'on' && Auth::user()->status == 'confirmed' ? 1 : 0,
            'market' => $request->market && $request->market == 'on' ? 1 : 0,
            'stop' => $request->stop && $request->stop == 'on' ? 1 : 0,
            'user_id' => Auth::id(),
            'leverage' => $request->leverage,
            'portfolio_id' => $request->portfolio_id,
            'trade_pair_id' => $request->trade_pair_id,
            'reserved_sum' => $request->reserved_sum
        ];

    }

    public function prepareActiveTradesForDisplay($trades)
    {

        $result = [];
        
        if($trades->count() > 0)
        {

            foreach($trades as $trade)
            {

                if(!is_object($trade)) 
                {
                    
                    continue;

                }

                $debt = $trade->amount * $trade->target_price;
                $currentPrice = 0;
                $income = 0;
                $spread = 0;

                if($trade->type == 'long' || $trade->type == 'short')
                {

                    $income = $trade->amount * $trade->tradePair->fromCurrency->usd_value;
                    $currentPrice = $trade->tradePair->fromCurrency->usd_value;
                }

                $rate = $trade->type === 'buy' || $trade->type === 'long' ? $trade->tradePair->rate : $trade->tradePair->rate_sell;
                $spread = abs($trade->target_price - $rate);

                $leverage = $trade->leverage > 0 ? $trade->leverage . ' x ' : '';
                $amount = $trade->leverage > 0 ? $trade->amount / $trade->leverage : $trade->amount;
                $profit = $trade->type == 'long' ? ($income - $debt) : ($debt - $income);
                $profit -= $this->tradeFeeService->getFeeInUsd($trade);
                   
                // Currencies
                if($trade->type == 'buy' || $trade->type == 'long')
                {

                    $currency = $trade->tradePair->fromCurrency;
                    $secondCurrency = $trade->tradePair->toCurrency;
                    $fromCurrency = $currency;
                    $toCurrency = $secondCurrency;

                } else {

                    $currency = $trade->tradePair->toCurrency;
                    $secondCurrency = $trade->tradePair->fromCurrency;
                    $fromCurrency = $currency;
                    $toCurrency = $secondCurrency;   

                }

                $fromCryptoCurrency = Currency::getClass($fromCurrency->acronym);
                $toCryptoCurrency = Currency::getClass($toCurrency->acronym);

                $volumePrecision = $fromCryptoCurrency->getDefaultPrecision();
                $profitPrecision = $toCryptoCurrency->getDefaultPrecision();   

                if($toCurrency->acronym === 'USD')
                {

                    $toPrecision = $fromCryptoCurrency->precisionIn('USD');

                } else {

                    $toPrecision = $toCryptoCurrency->precisionIn($fromCurrency->acronym);

                }                     

                $result[] = [
                    'id' => $trade->id,
                    'typeNoFormat' => $trade->type,
                    'status' => trans('TradeSubsystem/feed.status-'.$trade->type.'-'.$trade->status),
                    'type' => $trade->type == 'buy' || $trade->type == 'long' ? trans('TradeSubsystem/labels.buying') : trans('TradeSubsystem/labels.selling'),
                    'amount' => number_format($amount, $volumePrecision),
                    'leverage' => $leverage,
                    'profit' => number_format($profit, $profitPrecision),
                    'currentPrice' => number_format($currentPrice, $toPrecision),
                    'targetPrice' => $trade->target_price,
                    'payingSymbol' => $toCurrency->symbol,
                    'payingAcronym' => $toCurrency->acronym,
                    'buyingSymbol' => $fromCurrency->symbol,
                    'buyingAcronym' => $fromCurrency->acronym,
                    'statusNoFormat' => $trade->status,
                    'rate' => $rate,
                    'spread' => $spread,
                ];

            }

        }

        return $result;

    }

    public function prepareTradesForFeedPage($trades, $viewer = null)
    {

        if(!$viewer)
        {

            $viewer = Auth::check() ? Auth::user() : null;

        }

        $result = [
            'data' => [],
            'pagination' => '',
            'relLinks' => ''
        ];

        if($trades instanceof LengthAwarePaginator)
        {

            $result['pagination'] = Pagination::defaultPagination($trades);
            $result['relLinks'] = Pagination::defaultRelLinks($trades, 'trades');

        } 

        foreach($trades as $trade)
        {

            $user = $trade->author;
            $sign = $trade->type == 'buy' || $trade->type == 'long' ? '+' : '-';

            $currency = $trade->tradePair->fromCurrency;
            $secondCurrency = $trade->tradePair->toCurrency;
            $fromCurrency = $currency;
            $toCurrency = $secondCurrency;  

            $fromCryptoCurrency = Currency::getClass($fromCurrency->acronym);
            $toCryptoCurrency = Currency::getClass($toCurrency->acronym);  
            $precision = $fromCryptoCurrency->precisionIn($toCurrency->acronym);
            $toPrecision = $toCryptoCurrency->precisionIn($fromCurrency->acronym);
            
            $precision = $fromCryptoCurrency->precisionIn($fromCurrency->acronym);
            $volumePrecision = $fromCryptoCurrency->getDefaultPrecision();
            
            if($toCurrency->acronym === 'USD')
            {

                $toPrecision = $fromCryptoCurrency->precisionIn('USD');

            } else {

                $toPrecision = $toCryptoCurrency->precisionIn($fromCurrency->acronym);

            }
       
            $leverage = $trade->leverage > 0 ? $trade->leverage . ' x ' : '';
            $totalTradeValue = $trade->amount * $trade->target_price;
            $amount = $trade->leverage > 0 ? $trade->amount / $trade->leverage : $trade->amount;
            $comments = $this->tradeCommentRepository->paginate($trade->id, config('custom.perPage.tradeComments'), 1);
            $source = json_decode($trade->source,true);            

            /* IF TUBE show tooltip */

            $tooltip_html = '';

            $poster = '';

            if($trade->source_type === 'image')
            {

                $source = json_decode($trade->source, true);
                $url = 'images/analysis/'.$trade->id.'/'.$source['analysis_link'];
                $poster = Storage::disk('public')->url($url);

            }else if($trade->source_type === 'link')
            {

                $source = json_decode($trade->source, true);
                if(array_key_exists('link', $source)) $url = $source['link'];
                else{
                 $url = 'https://niffler.co/'; 
                }

                if(Strings::stringIsImageUrl($url))
                {

                    $poster = $url;

                }

            }

            $tradeArray = [
                'acronym' => $currency->acronym,
                'amount' => $sign . '' . number_format($amount, $volumePrecision) . ' <a '.$tooltip_html.' target="_blank" href="/app/cryptocurrencies/'.$currency->acronym.'">' . $currency->acronym . '</a>', 
                'avatar' => Media::getUserAvatar($user),
                'class' => $trade->type == 'buy' || $trade->type == 'long'  ? 'success' : 'danger',
                'comments' => $this->tradeCommentFormatter->prepareCommentsForFeedPage($comments),
                'date' => Time::formatDateForHumans($trade->created_at),
                'description' => $trade->description ? Strings::prepareTradeDescriptionForDisplay($trade) : '',
                'handle' => $user->handle,
                'hasMoreComments' => $comments->hasMorePages(),
                'id' => $trade->id,
                'userId' => $trade->author->id,
                'isPublic' => $trade->public == 1 && $user->status == 'confirmed' ? 1 : 0,
                'userCanSee' => true,
                'pair' => $trade->tradePair->fromCurrency->acronym.'/'.$trade->tradePair->toCurrency->acronym,
                'percents' => $user->mainPortfolio->portfolio_value_in_usd > 0 ? number_format($user->balances->where('currency_id', $currency->id)->first()->usd_value / $user->mainPortfolio->portfolio_value_in_usd * 100, 1) : 0,
                'source' => $source,
                'source_type' => $trade->source_type,   
                'target_price' => $secondCurrency->symbol . ' ' .number_format($trade->target_price, $toPrecision),
                'totalBalance' => Balance::portfolioTotalValue($trade->portfolio),
                'totalBalanceClass' => Balance::portfolioTotalBalanceClass($trade->portfolio),
                'typeNoFormat' => $trade->type,
                'username' => $user->username ? $user->username : null,
                'videoIframe' => $source && array_key_exists('video_link', $source) ? LaravelVideoEmbed::parse($source['video_link']) : '',
                'voted' => $viewer ? $this->tradeVoteRepository->voted($viewer->id, $trade->id) : false,
                'votes' => $trade->votes,
                'totalComments' => $trade->comments->count(),
                'ownTrade' => $viewer && $user->id == $viewer->id ? 1 : 0,
                'status' => $leverage . trans('TradeSubsystem/feed.status-'.$trade->type.'-'.$trade->status),
                'statusNoFormat' => $trade->status, 
                'hasTraderBadge' => $user->badges->contains('title', 'TRADER'), 
                'totalTradeValue' => $secondCurrency->symbol . ' ' . number_format($totalTradeValue, 2),
                'profit' => number_format($trade->profit, 2),
                'meta_title' => $trade->author->username . ' trade #' . $trade->id . ': ' . $sign . ' ' . number_format($trade->amount, $volumePrecision) . ' ' . $currency->acronym . ' ' . trans('TradeSubsystem/feed.status-'.$trade->type.'-'.$trade->status) . ' @ ' . $secondCurrency->symbol . ' ' .$trade->target_price,
                'meta_description' => $trade->public == 1 ? $trade->description : 'This trade is not public or for patrons only',
                'follow' => $trade->follow == 1 ? false : 1,
                'viewerId' => $viewer ? $viewer->id : null,
                'portfolioName' => $trade->portfolio->title,
                'portfolioValue' => Balance::portfolioTotalValue($trade->portfolio),
                'portfolioValueClass' => Balance::portfolioTotalBalanceClass($trade->portfolio),
                'isMainPortfolio' => $trade->portfolio->id === $trade->author->main_portfolio_id,
                'poster' => $poster
            ];

            $result['data'][] = $tradeArray;

        }

        return $result;

    }

    public function prepareActiveTradesForTableDisplay($trades)
    {

        $result['data'] = [];
        $result['pagination'] = Pagination::defaultPagination($trades);

        foreach($trades as $trade)
        {

            if(!is_object($trade)) 
            {
                
                continue;

            }

            $debt = $trade->amount * $trade->target_price;
            $currentPrice = 0;
            $income = 0;

            if($trade->type == 'long' || $trade->type == 'short')
            {

                $income = $trade->amount * $trade->tradePair->fromCurrency->usd_value;
                $currentPrice = $trade->tradePair->fromCurrency->usd_value;

            }

            $leverage = $trade->leverage > 0 ? $trade->leverage . ' x ' : '';
            $amount = $trade->leverage > 0 ? $trade->amount / $trade->leverage : $trade->amount;
            $fee = $this->tradeFeeService->calculateFee($trade);
            
            $profit = $trade->type == 'long' ? ($income - $debt) : ($debt - $income);
            $profit -= $this->tradeFeeService->getFeeInUsd($trade);
            
            if($trade->status == 'finished') $profit = $trade->profit - $fee; 
            
            $tradeCondition = $trade->tradeCondition;
            $currency = $trade->tradePair->toCurrency->id == 1 ? $trade->tradePair->fromCurrency : $trade->tradePair->toCurrency;
            $cryptoCurrency = Currency::getClass($currency->acronym);

            if($trade->tradePair->fromCurrency->id == 1 || $trade->tradePair->toCurrency->id == 1)
            {

                $precision = $cryptoCurrency->precisionIn('USD');

            } else {

                $precision = $cryptoCurrency->getDefaultPrecision();

            }

            $stopLoss = 'n/a';
            $takeProfit = 'n/a';

            if($tradeCondition)
            {

                if($trade->type == 'short')
                {

                    $takeProfit = '$'.number_format($tradeCondition->below_limit, $precision);
                    $stopLoss = '$'.number_format($tradeCondition->above_limit, $precision);

                } else {

                    $takeProfit = '$'.number_format($tradeCondition->above_limit, $precision);
                    $stopLoss = '$'.number_format($tradeCondition->below_limit, $precision);  

                }

            }      

            $item = $this->prepareTradeForTableDisplay($trade);

            $item['profitClass'] = ''; 

            if($trade->leverage > 0 && $profit < 0.001) $item['profitClass'] = 'text-danger';
            if($trade->leverage > 0 && $profit > 0.001) $item['profitClass'] = 'text-success';       

            $profit = '$'.number_format($profit, 2);
            $profit = str_replace('$-', '-$', $profit); 
          
            $item['opened'] = $trade->created_at->format('j M, Y');
            $item['profit'] = $trade->leverage > 0 ? $profit : 'n/a';
            $item['stopLoss'] = $stopLoss;
            $item['takeProfit'] = $takeProfit;
            $item['tradeFeeSymbol'] = $this->tradeFeeService->getFeeCurrency($trade)->symbol;
            $item['tradeFee'] = number_format($fee, 4);
            $result['data'][] = $item;
        }

        return $result;

    }

    private function prepareTradeForTableDisplay($trade)
    {

        $buyingCryptoCurrency = Currency::getClass($trade->tradePair->fromCurrency->acronym);
        $payingCryptoCurrency = Currency::getClass($trade->tradePair->toCurrency->acronym);  
        
        $pair = $trade->tradePair->fromCurrency->acronym . '/'. $trade->tradePair->toCurrency->acronym;

        if($trade->type == 'long' || $trade->type == 'buy')
        {

            $precision = $buyingCryptoCurrency->precisionIn($trade->tradePair->toCurrency->acronym);
            $volumePrecision = $buyingCryptoCurrency->getDefaultPrecision();

        } else {

            $precision = $payingCryptoCurrency->precisionIn($trade->tradePair->fromCurrency->acronym);
            $volumePrecision = $buyingCryptoCurrency->getDefaultPrecision();
            
        }
 
        return [
            'id' => $trade->id,
            'type' => trans('TradeSubsystem/labels.'.$trade->type),
            'leverage' => $trade->leverage == 0 ? 'n/a' : $trade->leverage,
            'profit' => $trade->leverage == 0 || $trade->status == 'open' ? 'n/a' : $trade->profit,
            'amount' => number_format($trade->amount, $volumePrecision),
            'targetPrice' => number_format($trade->target_price, $precision),
            'pair' => $pair,
            'cost' => $trade->open_price ? number_format($trade->open_price * $trade->amount, 1) : number_format($trade->target_price * $trade->amount, 1),
            'status' => $trade->status
        ];

    }

    public function prepareTradeFinishedTextForNotification($trade)
    {

        $buyingCryptoCurrency = Currency::getClass($trade->tradePair->fromCurrency->acronym);         

        $type = $trade->type == 'buy' || $trade->type == 'long' ? 'Buy' : 'Sell';
        $what = number_format($trade->amount, $buyingCryptoCurrency->getDefaultPrecision()) . ' ' . $trade->tradePair->fromCurrency->acronym;
        $for = $trade->tradePair->toCurrency->symbol . sprintf('%f', $trade->target_price);
        $result = $type . ' order #' . $trade->id . ' (' . $what . ' for ' . $for . ') was successfully completed';

        return $result;

    }

    public function prepareTradeLiquidatedTextForNotification($trade)
    {

        $buyingCryptoCurrency = Currency::getClass($trade->tradePair->fromCurrency->acronym);            

        $what = number_format($trade->amount, $buyingCryptoCurrency->getDefaultPrecision()) . ' ' . ($trade->type == 'buy' || $trade->type == 'long' ? $trade->tradePair->fromCurrency->acronym : $trade->tradePair->toCurrency->acronym);
        $for = ($trade->type == 'buy' || $trade->type == 'long' ? $trade->tradePair->toCurrency->symbol : $trade->tradePair->fromCurrency->symbol) . sprintf('%f', $trade->target_price);
        $result = 'Order #' . $trade->id . ' (' . $what . ' for ' . $for . ') was liquidated';

        return $result;

    }    

    public function prepareDataForVisibilityUpdate($data)
    {

        return [
            'public' => array_key_exists('public', $data) && $data['public'] == 'on' && Auth::user()->status == 'confirmed' ? 1 : 0
        ];

    }

}