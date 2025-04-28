<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\CompetitionPrizeRepositoryInterface;
use App\Model\Data\Models\CompetitionPrize;

class CompetitionPrizeRepository implements CompetitionPrizeRepositoryInterface
{

    public function create($args)
    {

        $prize = new CompetitionPrize;
        $prize->fill($args);
        $prize->save();

    }

    public function deleteByCompetitionId($competitionId)
    {

        CompetitionPrize::where('competition_id', $competitionId)->delete();

    }

}