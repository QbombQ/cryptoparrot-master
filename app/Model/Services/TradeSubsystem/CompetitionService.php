<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CompetitionServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BadgeServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\PortfolioServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\CompetitionFormatterInterface;
use App\Model\Contracts\Interfaces\Data\CompetitionRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\CompetitionParticipantRepositoryInterface;
use Auth;

class CompetitionService implements CompetitionServiceInterface
{

    protected $competitionFormatter;
    protected $competitionRepository;
    protected $competitionParticipantRepository;
    protected $badgeService;
    protected $balanceService;
    protected $emailService;
    protected $tradeService;
    protected $portfolioService;

    const COMPETITION_WON_NOTIFICATION_ID = 6;

    public function __construct(
        CompetitionFormatterInterface $competitionFormatter,
        CompetitionRepositoryInterface $competitionRepository,
        CompetitionParticipantRepositoryInterface $competitionParticipantRepository,
        BadgeServiceInterface $badgeService,
        BalanceServiceInterface $balanceService,
        NotificationServiceInterface $notificationService,
        EmailServiceInterface $emailService,
        TradeServiceInterface $tradeService,
        PortfolioServiceInterface $portfolioService
    )
    {

        $this->competitionFormatter = $competitionFormatter;
        $this->competitionRepository = $competitionRepository;
        $this->badgeService = $badgeService;
        $this->competitionParticipantRepository = $competitionParticipantRepository;
        $this->balanceService = $balanceService;
        $this->notificationService = $notificationService;
        $this->emailService = $emailService;
        $this->tradeService = $tradeService;
        $this->portfolioService = $portfolioService;

    }

    public function paginate($limit)
    {

        $competitions = $this->competitionRepository->paginate($limit);

        return $this->competitionFormatter->prepareCompetitionsForDisplay($competitions);

    }

    public function getActiveCompetitionsNot($userId, $portfolioId)
    {

        $competitions = $this->competitionParticipantRepository->getActiveCompetitionsExceptPortfolio($userId, $portfolioId);
        
        return $this->competitionFormatter->prepareCompetitionsForWidget($competitions);

    }

    public function participate($competitionId,$password = null)
    {

        $competition =  $this->competitionRepository->getById($competitionId);

        if($competition->is_private == 1)
        {

            return $this->competitionFormatter->prepareAjaxResponse(false, trans('TradeSubsystem/error-messages.competition-is-private'));

        }

        if($competition->password && !$password){

            return $this->competitionFormatter->prepareAjaxResponse(false, trans('TradeSubsystem/error-messages.requires-password'));

        }

        if($competition->password && $competition->password != $password){

            return $this->competitionFormatter->prepareAjaxResponse(false, trans('TradeSubsystem/error-messages.wrong-password-entered'));

        }
 
 
        if(!$this->badgeService->userHasBadges(Auth::user(), $competition->badges))
        {
            
            return $this->competitionFormatter->prepareAjaxResponse(false, trans('TradeSubsystem/error-messages.badges-missing'));
        
        }
        
        if($this->competitionParticipantRepository->userAlreadyParticipates(Auth::id(), $competition->id))
        {

            return $this->competitionFormatter->prepareAjaxResponse(false, trans('TradeSubsystem/error-messages.already-participating-in-competition'));

        }

        $participant = $this->competitionParticipantRepository->create(
            $this->competitionFormatter->prepareDataForCreation($competitionId, Auth::id())
        );

        if($competition->status > 0)
        {
            
            $response = $this->portfolioService->create([
                'user_id' => $participant->user->id,
                'title' => $competition->title . ' Portfolio'
            ]);
    
            $portfolio = $this->portfolioService->get($response['id']);
    
            $this->competitionParticipantRepository->update($participant->user->id,  $competition->id,  [
                'portfolio_start_value' => $portfolio->portfolio_value_in_usd,
                'portfolio_id' => $portfolio->id
            ]);

        }

        return $this->competitionFormatter->prepareAjaxResponse(true, trans('TradeSubsystem/success-messages.you-are-in'));

    }    

    public function get($competitionId)
    {

        $competition =  $this->competitionRepository->getById($competitionId);
        $competitionLeaders = $this->competitionParticipantRepository->getLeaders($competition); 

        $response = $this->competitionFormatter->prepareCompetitionForInnerDisplay($competition, $competitionLeaders);

        if($competition->status > 0)
        {

            $response['withoutTradesCount'] = $this->competitionParticipantRepository->withoutTradesCount($competition->id);

        }

        return $response;

    }

    public function startCompetitions()
    {

        $competitions = $this->competitionRepository->getCompetitionsThatNeedToBeStarted();
        
        if($competitions->count() > 0)
        {

            $this->balanceService->updateAllUsdValues();

            foreach($competitions as $competition)
            {

                $this->competitionRepository->update($competition->id, [
                    'status' => 1
                ]);
                $participants = $competition->competitionParticipants;

                if($participants->count() > 0)
                {

                    foreach($participants as $participant)
                    {

                        $response = $this->portfolioService->create([
                            'user_id' => $participant->user->id,
                            'title' => $competition->title . ' Portfolio'
                        ]);

                        if(!$response['success'])
                        {

                            \Log::error("FAILED TO CREATE PORTFOLIO FOR COMPETITION START. MESSAGE: " . $response['message']);
                            return;

                        }

                        $portfolio = $this->portfolioService->get($response['id']);

                        $this->competitionParticipantRepository->update($participant->user->id,  $competition->id,  [
                            'portfolio_start_value' => $portfolio->portfolio_value_in_usd,
                            'portfolio_id' => $portfolio->id
                        ]);
                        
                    }

                }

            }

        }

    }

    public function endCompetitions()
    {

        $competitions = $this->competitionRepository->getCompetitionsThatNeedToBeFinished();
        
        if($competitions->count() > 0)
        {

            foreach($competitions as $competition)
            {

                $this->competitionRepository->update($competition->id, [
                    'status' => 2
                ]);

            }            

            $this->balanceService->updateAllUsdValues();

            foreach($competitions as $competition)
            {

                $participants = $competition->competitionParticipants;

                if($participants->count() > 0)
                {

                    foreach($participants as $participant)
                    {

                        $openTrades = $participant->portfolio->trades->where('status', 'open');

                        if(!$openTrades->isEmpty())
                        {

                            foreach($openTrades as $trade)
                            {

                                $this->tradeService->closeTrade($trade->id, true);

                            }

                        }

                        $activeTrades = $participant->portfolio->trades->where('status', 'active');

                        if(!$activeTrades->isEmpty())
                        {

                            foreach($activeTrades as $trade)
                            {

                                $this->tradeService->cancelTrade($trade->id, true);

                            }

                        }               

                        $this->competitionParticipantRepository->update($participant->user->id,  $competition->id, [
                            'portfolio_end_value' => $participant->portfolio->portfolio_value_in_usd,
                            'current_portfolio_value' => $participant->portfolio->portfolio_value_in_usd,
                            'change' => $participant->portfolio->portfolio_value_in_usd / $participant->portfolio_start_value * 100 - 100
                        ]);

                        $participant->portfolio->closed = 1;
                        $participant->portfolio->save();

                        if($participant->user->current_portfolio_id === $participant->portfolio_id)
                        {

                            $participant->user->current_portfolio_id = $participant->user->main_portfolio_id;
                            $participant->user->save();

                        }

                    }

                }

                $competitionLeaders = $this->competitionParticipantRepository->getLeaders($competition);

                if($competitionLeaders->count() > 0)
                {

                    $k = 0;

                    foreach($competitionLeaders as $leader)
                    {

                        if($k > 0)
                        {

                            break;

                        }

                        $this->notificationService->createNotification(
                            $leader->user->id,
                            self::COMPETITION_WON_NOTIFICATION_ID,
                            trans('notifications.competition_won', [$competition->title]),
                            url('/app/competitions/' . $competition->id)
                        );
                        $this->emailService->sendNotificationAboutCompetition($leader->user->email, $competition->title);
                        $k++;

                    }

                }

            }

        }

    }    

    public function updateCompetitionParticipants()
    {

        $ongoingCompetitions = $this->competitionRepository->getOngoingCompetitions();

        if($ongoingCompetitions->count() > 0)
        {

            $this->balanceService->updateAllUsdValues();

            foreach($ongoingCompetitions as $competition)
            {

                $participants = $competition->competitionParticipants;

                if($participants->count() > 0)
                {

                    foreach($participants as $participant)
                    {

                        $this->competitionParticipantRepository->update($participant->user->id, $competition->id, [
                            'current_portfolio_value' => $participant->portfolio->portfolio_value_in_usd,
                            'change' => $participant->portfolio->portfolio_value_in_usd / $participant->portfolio_start_value * 100 - 100
                        ]);

                    }

                }     

            }
            
        }

    }

}