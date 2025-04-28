<?php 

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\Common\NotificationFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\BalanceFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\HistoricalServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\PortfolioServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Data\TradeRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\FollowRepositoryInterface;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Avatar;
use Balance;
use Currency;
use Media;
use Time;

class UserFormatter implements UserFormatterInterface
{

    protected $balanceFormatter;
    protected $tradeFormatter;
    protected $notificationFormatter;
    protected $historicalService;
    protected $tradeRepository;
    protected $followRepository;
    protected $tradeService;
    protected $portfolioService;

    public function __construct(
        BalanceFormatterInterface $balanceFormatter,
        TradeFormatterInterface $tradeFormatter,
        NotificationFormatterInterface $notificationFormatter,
        HistoricalServiceInterface $historicalService,
        TradeRepositoryInterface $tradeRepository,
        FollowRepositoryInterface $followRepository,
        TradeServiceInterface $tradeService,
        PortfolioServiceInterface $portfolioService
    )
    {

        $this->balanceFormatter = $balanceFormatter;
        $this->tradeFormatter = $tradeFormatter;
        $this->notificationFormatter = $notificationFormatter;
        $this->historicalService = $historicalService;
        $this->tradeRepository = $tradeRepository;
        $this->followRepository = $followRepository;
        $this->tradeService = $tradeService;
        $this->portfolioService = $portfolioService;

    }

    public function prepareCommonUserDataForTradeSubsystem($user)
    {

        $usdCurrency = Currency::getClass('USD');
        $notifications = $user->notifications->sortByDesc('created_at')->slice(0,4);
        $data['notifications'] = $this->notificationFormatter->prepareNotificationsForBubbleDisplay($notifications);
        $data['unreadConversations'] = [];
        $unreadConversations = $user->initiatedConversations->where('initiator_status', 'unread')->merge($user->receivedConversations->where('recipient_status', 'unread'));
        
        if($unreadConversations->count() > 0)
        {

            foreach($unreadConversations as $conversation)
            {

                if($conversation->messages->count() > 0)
                {

                    $data['unreadConversations'][] = $conversation->id;

                }

            }

        }

        if(!$user->currentPortfolio) 
        {

            $user->current_portfolio_id = $user->main_portfolio_id;
            $user->save();

        }
        
        $data['id'] = $user->id;
        $data['unreadCount'] = $notifications->where('status', 'unread')->count();
        $data['avatar'] = Media::getUserAvatar($user);
        $data['username'] = isset($user->username) ? $user->username : null;
        $data['email'] = isset($user->email) ? $user->email : null;
        $data['status'] = $user->status;  
        $data['handle'] = $user->handle ? $user->handle : null;
        $data['conversations'] = $user->initiatedConversations->merge($user->receivedConversations)->pluck('id')->toArray();

        $data['portfolios'] = $this->portfolioService->getForSelect(Auth::id());
        $data['portfolioValueInUsd'] =  number_format($user->currentPortfolio->portfolio_value_in_usd, $usdCurrency->getDefaultPrecision(), '.', ','); 
        //$data['portfolioValueInUsdHistory'] = $this->historicalService->getUserPortfolioHistoricalData($user->id);
        $data['overallAmount'] = $user->mainPortfolio->balances->where('currency_id', Currency::dollar()->id)->first()->amount - $user->earn_play_dollars_reward_diff;
        $data['userBalancesPercents'] = $this->preparePortfolioBalancesPercents($user->currentPortfolio);

        if($user->main_portfolio_id === $user->current_portfolio_id)
        {

            $data['portfolioValueChanges'] = $this->historicalService->getUserPortfolioValueChanges($user);

            $data['portfolioValueChangeIn'] = $this->portfolioValueChangesFirstNotNull($data['portfolioValueChanges']);



        }else{

            if($user->currentPortfolio->portfolio_value_in_usd / $user->currentPortfolio->start_portfolio_value_in_usd * 100 - 100 > 0) 
            {

                $class = 'text-success';

            }else{

                $class = 'text-danger';

            }
            
            $data['portfolioValueChangeIn']['value'] = '<span class="' . $class . '">' . number_format($user->currentPortfolio->portfolio_value_in_usd / $user->currentPortfolio->start_portfolio_value_in_usd * 100 - 100, 1) . '%</span>';
            $data['portfolioValueChangeIn']['label'] = 'since start';
            $data['portfolioValueChanges']['lifetime'] = $user->currentPortfolio->portfolio_value_in_usd - $user->currentPortfolio->start_portfolio_value_in_usd;
        }

        $data['made_trade'] = Auth::user()->trades->count() > 0 ? true : false;
        
        $countableTrades = $this->tradeRepository->getTradesForAverageProfitLossCount($user->id);

        if($countableTrades > 0)
        {

            $data['averageProfitLoss'] = number_format($data['portfolioValueChanges']['lifetime'] / $countableTrades, 2, '.', ',');

        } else { 

            $data['averageProfitLoss'] = 0;

        }

        return $data;

    }

    private function portfolioValueChangesFirstNotNull($portfolioValueChanges)
    {

        if($portfolioValueChanges['7days'])
        {

            $class = $portfolioValueChanges['7days'] > 0 ? 'text-success' : 'text-danger';
            $data = [
                'label' => 'since start',
                'value' => '<span class="' . $class . '">' . number_format($portfolioValueChanges['7days'], 1) . '%</span>'
            ];            

        } else {

            $class = $portfolioValueChanges['lifetime'] > 0 ? 'text-success' : 'text-danger';
            $data = [
                'label' => 'since start',
                'value' => '<span class="' . $class . '">' . number_format($portfolioValueChanges['lifetime'], 1) . '%</span>'
            ];

        }

        return $data;

    }

    private function preparePortfolioBalancesPercents($portfolio)
    {

        $result['labels'] = [];
        $result['values'] = [];
        $result['colors'] = [];

        //$colors = config('custom.currency_colors');

        $balances = $portfolio->balances;

        if($balances->count() > 0)
        {

            foreach($balances as $balance)
            {

                $result['labels'][] = $balance->currency->name;
                $result['values'][] = $portfolio->portfolio_value_in_usd > 0 ? number_format($balance->usd_value / $portfolio->portfolio_value_in_usd * 100, 2) : 0;   
                //$result['colors'][] = $colors[$balance->currency->acronym];        
            
            }
       
        }

        return $result;

    }

    public function prepareUserForProfilePage($user)
    {

        if(!$user) return [];
    
        $portfolioValueChanges = $this->historicalService->getUserPortfolioValueChanges($user);
        $countableTrades = $this->tradeRepository->getTradesForAverageProfitLossCount($user->id);

        if($countableTrades > 0)
        {

            $averageProfitLoss = number_format($portfolioValueChanges['lifetime'] / $countableTrades, 2, '.', ',');

        } else {

            $averageProfitLoss = 0;

        }

        $usdCurrency = Currency::getClass('USD');

        return [
            'userId' => $user->id,
            'username' => $user->username ? $user->username : null,
            'handle' => $user->handle ? $user->handle : null,
            'location' => $user->location ? $user->location : null,
            'joined' => $user->created_at->format('M Y'),
            'description' => $user->description ? $user->description : null,
            'avatar' => Media::getUserAvatar($user),
            'cover' => Media::getUserCover($user, false, 1000, 400),
            'socialMediaAccounts' => $user->socialMediaAccounts,
            'badges' => $this->prepareBadgesForDisplay($user->badges),
            'trades' => $this->tradeService->getUserTrades($user->id),
            'tradesCount' => $user->trades->where('archived', 0)->count(),
            'followers' => $user->followers,
            'followings' => $user->followings,
            'balances' => $this->balanceFormatter->prepareUserBalancesForPortfolioDisplay($user->mainPortfolio->balances->sortBy('id')),
            'totalBalance' => Balance::portfolioTotalValue($user->mainPortfolio),
            'totalBalanceClass' => Balance::portfolioTotalBalanceClass($user->mainPortfolio),
            'alreadyFollow' => Auth::check() && $user->followers->contains('follower_id', Auth::id()),
            'portfolioValueInUsd' => number_format($user->mainPortfolio->portfolio_value_in_usd, $usdCurrency->getDefaultPrecision(), '.', ','),
            'userBalancesPercents' => $this->preparePortfolioBalancesPercents($user->mainPortfolio),
            //'portfolioValueInUsdHistory' => $this->historicalService->getUserPortfolioHistoricalData($user->id),
            'portfolioValueChanges' => $portfolioValueChanges,
            'portfolioValueChangeIn' => $this->portfolioValueChangesFirstNotNull($portfolioValueChanges),        
            'averageProfitLoss' => $averageProfitLoss,        
            'hasTraderBadge' => $user->badges->contains('title', 'TRADER')
        ]; 

    }

    private function prepareBadgesForDisplay($badges)
    {

        $result = [];

        if($badges->count() > 0)
        {

            foreach($badges as $badge)
            {

                $result[] = [
                    'title' => $badge->title,
                    'description' => $badge->description,
                    'is_branded' => $badge->is_branded,
                    'icon' => $badge->icon,
                    'class' => $this->url($badge->title)
                ];

            }

        }
        
        return $result;

    }

    public function prepareUserForSettingsPage($user)
    {

        if(!$user) return [];

        return [
            'userId' => $user->id,
            'username' => $user->username ? $user->username : null,
            'handle' => $user->handle ? $user->handle : null, 
            'email' => $user->email ? $user->email : null,
            'joined' => $user->created_at->format('M Y'),
            'description' => $user->description ? $user->description : null,
            'location' => $user->location ? $user->location : null,
            'avatar' => Media::getUserAvatar($user),
            'cover' => Media::getUserCover($user, false, 1000, 400),
            'facebook' => $user->socialMediaAccounts->contains('social_network', 'facebook') ?
                                $user->socialMediaAccounts->where('social_network', 'facebook')->first()->url :
                                null,
            'twitter' => $user->socialMediaAccounts->contains('social_network', 'twitter') ?
                                $user->socialMediaAccounts->where('social_network', 'twitter')->first()->url :
                                null,
            'badges' => $user->badges,
            'trades' => $user->trades,
            'followers' => $user->followers,
            'followings' => $user->followings,
            'notifications' => $user->notificationSettings    
        ];

    }    

    public function prepareRequestDataForProfileUpdate($data)
    {

        $result = [
            'username' => $data['username'],
            'location' => $data['location'],
            'description' => $data['description']           
        ];

        if(Auth::user()->email != $data['email']) 
        {

            $result['email'] = strtolower($data['email']);
            $result['status'] = 'unconfirmed';

        }

        return $result;

    }

    public function prepareRequestDataForPasswordUpdate($data)
    {

        return [
            'password' => Hash::make($data['new_password'])
        ];

    }    
  
    public function prepareRequestDataForAvatarUpdate($request)
    {

        return [
            'avatar' => $request->path
        ];

    }

    private  function url($url) 
    {

        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
        $url = trim($url, "-");
        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
        $url = strtolower($url);
        $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

        return $url;

     }

    public function prepareRequestDataForCoverUpdate($request)
    {

        return [
            'cover' => $request->path
        ];

    }    

    public function prepareAvatarPathForDisplaying($path)
    {

        return [
            'path' => Storage::disk('public')->url($path['path']),
            'fullSizePath' => Storage::disk('public')->url($path['fullSizePath'])
        ];

    }    

    public function prepareCoverPathForDisplaying($path)
    {

        return Storage::disk('public')->url($path);
        
    }     

    public function prepareUsersForTopTradersPage($users, $criteria)
    {


        $topTraders = [];

        foreach($users as $user)
        {       

            if($criteria == 'lifetime')
            {

                $tradesCount = $user->trades->count();
                $increase = number_format(
                    ($user->mainPortfolio->portfolio_value_in_usd - $user->earn_play_dollars_reward_diff) / $user->mainPortfolio->start_portfolio_value_in_usd * 100 - 100,
                    0,
                    '.',
                    ','
                ).'%';
            
            } else {

                $tradesCount = $this->tradeRepository->getTradesCountSince($criteria, $user->id);

                if($user->portfolio_usd_value == 0)
                {

                    $increase = '1000%';

                } else {

                    $increase = number_format(($user->mainPortfolio->portfolio_value_in_usd - $user->earn_play_dollars_reward_diff) / $user->portfolio_usd_value * 100 - 100, 0, '.', ',').'%';
                
                }

            }

            $topTraders[] = [
                'userId' => $user->id,
                'handle' => $user->handle,
                'username' => $user->username ? $user->username : null,
                'avatar' => Media::getUserAvatar($user),
                'cover' => Media::getUserCover($user),
                'increaseInPercents' => $increase,
                'increaseClass' => 'positive',
                'tradesCount' => $tradesCount,
                'claimed' => $user->claimed,
                'alreadyFollow' => Auth::check() && $this->followRepository->alreadyFollows($user->id, Auth::id())
            ];
        }

        return $topTraders;

    }    

    public function prepareUsersForTopTradersPageAjax($users, $criteria)
    {

        if($users->count() == 0)
        {

            return [
                'success' => false
            ];

        }

        $currentPage = $users->currentPage();
        $response['traders'] = $this->prepareUsersForTopTradersPage($users, $criteria);
        $slides = [];
        $k = 0;

        foreach($response['traders'] as $trader)
        {

            $k++;
            $array['trader'] = $trader;
            $array['trader']['iteration'] = ($currentPage - 1) * config('custom.perPage.topTraders') + $k;
            $slides[] = view('pages/TradeSubsystem/common/trader', $array)->render();
            
        }

        return [
            'success' => true,
            'slidesCount' => count($slides),
            'slides' => $slides
        ];        

    }        
    
}