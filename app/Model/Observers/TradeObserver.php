<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\HistoricalServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface as TradeSubsystemTradeService;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeFeeServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\BadgeServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeFormatterInterface;
use App\Model\Events\NewTrade;
use App\Model\Data\Models\Trade;
use App\Model\Data\Models\User;
use App;
use App\Model\Facades\Trade as TradeFacade;

class TradeObserver
{

    protected $notificationService;
    protected $emailService;
    protected $balanceService;
    protected $tradeFormatter;
    protected $badgeService;
    protected $tradeSubsystemTradeService;
    protected $userService;
    protected $historicalService;
    protected $tradeFeeService;

    const TRADE_COMPLETED_NOTIFICATION_ID = 1;
    const POSITION_LIQUIDATED_NOTIFICATION_ID = 8;
    const FIRST_TRADE_NOTIFICATION_ID = 11;
    
    public function __construct(
        NotificationServiceInterface $notificationService,
        EmailServiceInterface $emailService,
        BalanceServiceInterface $balanceService,
        TradeFormatterInterface $tradeFormatter,
        BadgeServiceInterface $badgeService,
        TradeSubsystemTradeService $tradeSubsystemTradeService,
        UserServiceInterface $userService,
        HistoricalServiceInterface $historicalService,
        TradeFeeServiceInterface $tradeFeeService
    )
    {

        $this->notificationService = $notificationService;
        $this->emailService = $emailService;
        $this->balanceService = $balanceService;
        $this->tradeFormatter = $tradeFormatter;
        $this->badgeService = $badgeService;
        $this->tradeSubsystemTradeService = $tradeSubsystemTradeService;
        $this->userService = $userService;
        $this->historicalService = $historicalService;
        $this->tradeFeeService = $tradeFeeService;
        
    }    

    public function updated(Trade $trade)
    {
        
        if($trade->isDirty('status'))
        { 
            
            if($trade->status == 'finished')
            {

                if($trade->author->notificationSettings->trade_orders == 1)
                {

                    $notification = $this->notificationService->createNotification(
                        $trade->user_id,
                        self::TRADE_COMPLETED_NOTIFICATION_ID,
                        $this->tradeFormatter->prepareTradeFinishedTextForNotification($trade),
                        url('') . '/' . $trade->author->handle . '/trade/' . $trade->id
                    );

                    if(!$trade->author->isOnline())
                    {

                        $this->emailService->sendNotificationAboutCompletedTrade($trade);

                    }

                }

                $this->tradeFeeService->create($trade);
                $this->balanceService->updateUsdValues($trade->author->handle);
                $changes = $this->historicalService->getUserPortfolioValueChanges($trade->author);

                if(!$trade->author->badges->contains('title', 'TRADER') && $this->userService->canGetTraderBadge($trade->user_id, $changes))
                {

                    $this->badgeService->give([
                        'badge_id' => 4,
                        'user_id' => $trade->user_id
                    ]);

                }
                

            }

            if($trade->status == 'liquidated')
            {

                if($trade->author->notificationSettings->trade_orders == 1)
                {

                    $notification = $this->notificationService->createNotification(
                        $trade->user_id,
                        self::POSITION_LIQUIDATED_NOTIFICATION_ID,
                        $this->tradeFormatter->prepareTradeLiquidatedTextForNotification($trade),
                        url('') . '/' . $trade->author->handle . '/trade/' . $trade->id
                    );

                    if(!$trade->author->isOnline())
                    {

                        $this->emailService->sendNotificationAboutCompletedTrade($trade);

                    }

                }

                $this->tradeFeeService->create($trade);
                $this->balanceService->updateUsdValues($trade->author->handle);

            }  

        }       
        
    }

    public function created(Trade $trade)
    {

        $mentionService = App::make('App\Model\Contracts\Interfaces\Services\Common\MentionServiceInterface');
        $mentionService->mention($trade->description, $trade, $trade->author->username);    

        $this->balanceService->updateUsdValues($trade->author->handle);

        if($trade->market == 1)
        {

            $tradeFacade = new TradeFacade();
            $tradeFacade->finishTrade($trade);

        }
 
        if($trade->author->trades->count() >= 30)
        {

            $this->badgeService->give([
                'badge_id' => 2,
                'user_id' => $trade->user_id
            ]);

        }

        $tradeRepository = \App::make('App\Model\Contracts\Interfaces\Data\TradeRepositoryInterface');
        $sameTrades = $tradeRepository->getUserTradesByPairId($trade->user_id, $trade->trade_pair_id);

        try {

            if($sameTrades->count() == 1)
            {
                
                $this->notificationService->createNotification(
                    $trade->user_id,
                    self::FIRST_TRADE_NOTIFICATION_ID,
                    trans('notifications.first_trade', [$trade->tradePair->firstTradeWithCurrency->acronym]),
                    url('') . '/app/cryptocurrencies/'.$trade->tradePair->firstTradeWithCurrency->acronym
                );
                
            }

            /*$this->emailService->sendEmailToAdministratorAboutEvent('new-trade', [
                'message' => 'New trade : ' . url('/'.$trade->author->handle.'/trade/'.$trade->id)
            ]);*/ 

        }catch(\Exception $e)
        {

            \Log::error($e);

        }

        if($trade->author->ghosted !== 1)
        {

            event(new NewTrade($trade->id));

        }

    }

}