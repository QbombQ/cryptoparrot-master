<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\CompetitionParticipantRepositoryInterface;
use App\Model\Data\Models\CompetitionParticipant;
use App\Model\Data\Models\User;
use Carbon\Carbon;

class CompetitionParticipantRepository implements CompetitionParticipantRepositoryInterface
{

    public function create($data)
    {

        $competitionParticipant = new CompetitionParticipant;
        $competitionParticipant->fill($data);
        $competitionParticipant->save();

        return $competitionParticipant;

    }

    public function withoutTradesCount($competitionId)
    {

        return CompetitionParticipant::whereHas('portfolio', function($q) {
            $q->whereDoesntHave('trades');
        })->where('competition_id', $competitionId)->count();

    }

    public function userAlreadyParticipates($userId, $competitionId)
    {

        return CompetitionParticipant::where('user_id', $userId)->where('competition_id', $competitionId)->exists();

    }

    public function getActiveCompetitionsExceptPortfolio($userId, $portfolioId)
    {

        return CompetitionParticipant::with('competition')->whereHas(
            'competition', function ($query) {
                $query->where('status', 1);
            })->where('user_id', $userId)->where('portfolio_id', '!=', $portfolioId)->get();

    }

    public function getCountUsersThatDoesNotHaveTrades($competitionId, $startDate, $endDate)
    {

        $competitionParticipant = new CompetitionParticipant;
        $query = $competitionParticipant->newQuery();
        
        $query->join('trades', 'competition_participants.user_id', '=', 'trades.user_id')
            ->whereBetween('trades.created_at', [$startDate, $endDate])
            ->where('competition_id', $competitionId);

        $countThatHasTrades = $query->get()->unique('user_id')->count();  
        $countAll = CompetitionParticipant::where('competition_id', $competitionId)->get()->count();

        return $countAll - $countThatHasTrades;        

    }

    public function getUsersThatDoesNotHaveTrades($competitionId, $startDate, $endDate)
    {

        return User::whereDoesntHave('trades', function($q) use($startDate, $endDate) 
        {

            return $q->whereBetween('created_at', [$startDate, $endDate]);

        })->whereHas('competitions', function($q) use($competitionId) 
        {

            return $q->where('competitions.id', $competitionId);

        })->get()->pluck('email')->toArray();  

    }

    public function getLeaders($competition)
    {

        $competitionParticipant = new CompetitionParticipant;
        $query = $competitionParticipant->newQuery();
   
        if($competition->status > 0)
        {

            $query->whereHas('portfolio', function($q) 
            {

                $q->whereHas('trades');

            })->where('competition_id', $competition->id)->orderBy('change', 'desc')->get();

        }

        $query->where('competition_participants.competition_id', $competition->id);
        $query->orderBy('change', 'desc'); 
        
        return $query->paginate(40);       

    } 

    public function update($participantId, $competitionId, $data)
    {

        $participant = CompetitionParticipant::where('user_id', $participantId)->where('competition_id', $competitionId)->first();
        
        if($participant)
        {

            $participant->fill($data);
            $participant->save();
            
        }

    }

    public function getParticipant($userId, $competitionId)
    {

        return CompetitionParticipant::where('user_id', $userId)->where('competition_id', $competitionId)->first();

    }

    public function getUserCompetitions($userId, $status = [1,2,3])
    {

        return CompetitionParticipant::where('user_id', $userId)->whereHas('competition', function($q) use($status) 
        {

            $q->whereIn('status', $status);
            
        })->get();

    }

}