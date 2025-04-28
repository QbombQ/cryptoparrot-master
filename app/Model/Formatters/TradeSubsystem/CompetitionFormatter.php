<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\CompetitionFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\Common\CompetitionPrizeFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeFormatterInterface;
use App\Model\Contracts\Interfaces\Data\FollowRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\TradeRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\CompetitionParticipantRepositoryInterface;
use App\Model\Data\Models\CompetitionParticipant;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Avatar;
use Pagination;
use Number;
use Currency;
use Balance;
use Media;
use Time;

class CompetitionFormatter implements CompetitionFormatterInterface
{

    protected $followRepository;
    protected $tradeRepository;
    protected $competitionParticipantRepository;
    protected $tradeFormatter;
    protected $competitionPrizeFormatter;

    public function __construct(
        FollowRepositoryInterface $followRepository,
        TradeRepositoryInterface $tradeRepository,
        CompetitionParticipantRepositoryInterface $competitionParticipantRepository,
        TradeFormatterInterface $tradeFormatter,
        CompetitionPrizeFormatterInterface $competitionPrizeFormatter
    )
    {
        $this->followRepository = $followRepository;
        $this->tradeRepository = $tradeRepository;
        $this->competitionParticipantRepository = $competitionParticipantRepository;
        $this->tradeFormatter = $tradeFormatter;
        $this->competitionPrizeFormatter = $competitionPrizeFormatter;
    } 

    public function prepareCompetitionsForWidget($competitions)
    {

        $results = [];

        if(!$competitions->isEmpty())
        {

            foreach($competitions as $competition)
            {

                $results[] = [
                    'competitionTitle' => $competition->competition->title,
                    'portfolioTitle' => $competition->portfolio->title
                ];

            }

        }

        return $results;

    }

    public function prepareCompetitionsForDisplay($competitions)
    {

        $results = [
            'competitions' => [],
            'pagination' => ''
        ];

        if($competitions instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($competitions);
            $results['relLinks'] = Pagination::defaultRelLinksNoReplacement($competitions);

        }        

        if($competitions->count() > 0)
        {

            foreach($competitions as $competition)
            {

                $participants = $competition->participants->sortByDesc('created_at');
                $badgeTitles = $competition->badges->pluck('title')->toArray();
                $duration = $competition->end_date ?
                    Carbon::parse($competition->end_date)->diffForHumans(Carbon::parse($competition->start_date), true, false, 6) : null;
                $results['competitions'][] = [
                    'id' => $competition->id,
                    'status' => $competition->status,
                    'title' => $competition->title,
                    'start_date' => $competition->start_date ? Carbon::parse($competition->start_date)->format('dS M') : '',
                    'ends_in' => $competition->end_date ? Carbon::parse($competition->end_date)->diffForHumans(Carbon::now(), true, true, 3) : null,
                    'end_date' => $competition->end_date,
                    'end_date_formatted' => $competition->end_date ? Carbon::parse($competition->end_date)->format('dS M, Y') : '',
                    'already_participates' => $participants->contains('id', Auth::id()),
                    'starts_in' => $competition->start_date ? Carbon::parse($competition->start_date)->diffForHumans(Carbon::now(), true, true, 3) : null,
                    'badges_count' => $competition->badges->count(),
                    'required_badges' => implode(', ', $badgeTitles),
                    'duration' => $duration,
                    'prizes' => $competition->prize,
                    'password' => $competition->password,
                    'geo' => $competition->geo, 
                    'description' => $competition->description, 
                    'is_private' => $competition->is_private, 
                    'logo' => $competition->logo ? Storage::disk('public')->url($competition->logo) : '',
                    'cover' => $competition->cover ? Storage::disk('public')->url($competition->cover) : '',
                    'participantAvatars' => $this->prepareParticipantAvatars($participants),
                    'participantsCount' => $competition->competitionParticipants->count()
                ]; 

            }

        }

        return $results;        

    }
 
    public function prepareCompetitionForInnerDisplay($competition, $competitionLeaders)
    {

        $participants = $competition->participants->sortByDesc('created_at');
        $badgeTitles = $competition->badges->pluck('title')->toArray();
        $duration = $competition->end_date ? Carbon::parse($competition->end_date)->diffForHumans(Carbon::parse($competition->start_date), true) : null;

        if(!Auth::check())
        {

            $alreadyParticipates = false;

        } else {

            $alreadyParticipates = $participants->contains('id', Auth::id());

        }

        $currentPage = 1; 

        if($competitionLeaders instanceof LengthAwarePaginator)
        {

            $response['pagination'] = Pagination::defaultPagination($competitionLeaders);
            $response['relLinks'] = Pagination::defaultRelLinksNoReplacement($competitionLeaders);
            $currentPage = $competitionLeaders->currentPage();

        }

        $response['data'] = [
            'id' => $competition->id,
            'status' => $competition->status,
            'title' => $competition->title,
            'password' => $competition->password,
            'geo' => $competition->geo, 
            'start_date' => $competition->start_date, 
            'end_date' => $competition->end_date,
            'end_date_formatted' => $competition->end_date ? Carbon::parse($competition->end_date)->format('dS M, Y') : '',
            'already_participates' => $alreadyParticipates,
            'starts_in' => $competition->start_date ? Carbon::parse($competition->start_date)->diffForHumans(Carbon::now(), true, true, 3) : null,
            'ends_in' => $competition->end_date ? Carbon::parse($competition->end_date)->diffForHumans(Carbon::now(), true, true, 3) : null,
            'badges_count' => $competition->badges->count(),
            'required_badges' => implode(', ', $badgeTitles),
            'duration' => $duration,
            'prizes' => $competition->prize,
            'description' => $competition->description, 
            'is_private' => $competition->is_private, 
            'logo' => $competition->logo ? Storage::disk('public')->url($competition->logo) : '',
            'cover' => $competition->cover ? Storage::disk('public')->url($competition->cover) : '',
            'participantAvatars' => $this->prepareParticipantAvatars($participants),
            'participantsCount' => $competition->competitionParticipants->count()
        ];

        $response['leaders'] = [];
        $response['withoutTrades'] = [];
        $response['topLeaders'] = [];
        
        if($competitionLeaders->count() > 0)
        {

            $k = 1;
            foreach($competitionLeaders as $leader)
            {
                
                $leaderUser = $leader->user;
                $tradesCount = $leader->portfolio ? $leader->portfolio->trades->count() : 0;
                $increase = $leader->change;

                $currency = Currency::getClass('USD');
                $leaderStats = [
                    'userId' => $leaderUser->id,
                    'username' => $leaderUser->username,
                    'handle' => $leaderUser->handle,
                    'position' => $leader->portfolio_start_value ? ((($currentPage-1) * 40) + $k++)  : 'n/a',  
                    'currentPortfolioValue' => number_format($leader->current_portfolio_value, $currency->getDefaultPrecision(), '.', ','),
                    'portfolioValueAtStart' => $leader->portfolio_start_value ? number_format($leader->portfolio_start_value, $currency->getDefaultPrecision(), '.', ',') : 'n/a',
                    'portfolioValueAtEnd' => $leader->portfolio_end_value ? number_format($leader->portfolio_end_value, $currency->getDefaultPrecision(), '.', ',') : 'n/a',
                    'change' => $leader->portfolio_start_value ? number_format($leader->change, 2) . '%' : 'n/a',
                    'avatar' => Media::getUserAvatar($leaderUser),
                    'cover' => Media::getUserCover($leaderUser),
                    'increaseInPercents' => $increase . '%',
                    'increaseClass' => Balance::increaseClass($increase),
                    'tradesCount' => $tradesCount,
                    'alreadyFollow' => Auth::check() && $this->followRepository->alreadyFollows($leaderUser->id, Auth::id())                        
                ];

                $response['leaders'][] = $leaderStats;

            }

        }
        
        if($alreadyParticipates)
        {

            $participant = $this->competitionParticipantRepository->getParticipant(Auth::id(), $competition->id);
            $tradesCount = $participant->portfolio ? $participant->portfolio->trades->count() : 0;
            $changeClass = Balance::increaseClass($participant->change);

            $allParticipants = CompetitionParticipant::whereHas('portfolio', function($q) {
                $q->whereHas('trades');
            })->where('competition_id', $competition->id)->orderBy('change', 'desc')->get();
         
            $position = 0;

            foreach($allParticipants as $user)
            {

                $position++;

                if($user->user_id == Auth::id())
                {

                    break;

                }

            }

            $response['myData'] = [
                'change' => Number::addSign(number_format($participant->change, 1)).'%',
                'portfolio_start_value' => '$'.number_format($participant->portfolio_start_value),
                'portfolio_end_value' => '$'.number_format($participant->portfolio_end_value),
                'current_portfolio_value' => '$'.number_format($participant->current_portfolio_value),
                'myPosition' => $competition->status > 0 && $tradesCount > 0 ?  Number::ordinal($position) : 0,
                'tradesCount' => $tradesCount,
                'changeClass' => $changeClass
            ];
            
        }

        return $response;

    }

    private function prepareParticipantAvatars($participants)
    {

        $result = [];
        $participantsArray = $participants->toArray();

        if(count($participantsArray) > 0)
        {

            $imagesLimit = 2;

            // fill results with images
            for($i = 0; $i < $imagesLimit && $i < count($participantsArray); $i++)
            {

                $result[] = [
                    'type' => 'url',
                    'url' => Media::getUserAvatar($participantsArray[$i])
                ];
                
            }

            // if necessary, add image with +8 sign for example.
            if(count($participantsArray) > $imagesLimit)
            {

                $result[] = [
                    'type' => 'text',
                    'text' => '+'.(count($participantsArray)-$imagesLimit)
                ];                

            }
            
        }

        return $result;

    }
 
    public function prepareAjaxResponse($success, $message)
    {

        return [
            'success' => $success,
            'message' => $message
        ];

    }

    public function prepareDataForCreation($competitionId, $userId)
    {

        return [
            'competition_id' => $competitionId,
            'user_id' => $userId,
            'portfolio_start_value' => null
        ];

    }

}