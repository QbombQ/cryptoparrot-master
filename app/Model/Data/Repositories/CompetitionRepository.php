<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\CompetitionRepositoryInterface;
use App\Model\Data\Models\Competition;
use Carbon\Carbon;

class CompetitionRepository implements CompetitionRepositoryInterface
{

    public function paginate($limit)
    {

        return Competition::orderBy('created_at', 'desc')->paginate($limit);

    }

    public function create($data)
    {
    
        $competition = new Competition;
        $competition->fill($data);
        $competition->save();

        return $competition->id;

    }

    public function update($competitionId, $data)
    {

        $competition = Competition::find($competitionId);

        if($competition)
        {

            $competition->fill($data);
            $competition->save();
            
            return $competition->id;

        }

    }        

    public function getById($competitionId)
    {

        return Competition::findOrFail($competitionId);

    }

    public function getCompetitionsThatNeedToBeStarted()
    {

        $startDate = Carbon::now()->subMinutes(1);
        $endDate = Carbon::now()->addMinutes(1);

        return Competition::where('status', 0)->whereBetween('start_date', [$startDate, $endDate])->get();

    }

    public function getCompetitionsThatNeedToBeFinished()
    {

        $startDate = Carbon::now()->subMinutes(1);
        $endDate = Carbon::now()->addMinutes(1);
        
        return Competition::where('status', 1)->whereBetween('end_date', [$startDate, $endDate])->get();

    }

    public function getOngoingCompetitions()
    {

        return Competition::where('status', 1)->get();

    }

    public function all()
    {

        return Competition::all();

    }

}