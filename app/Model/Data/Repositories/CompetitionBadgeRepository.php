<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\CompetitionBadgeRepositoryInterface;
use App\Model\Data\Models\CompetitionBadge;

class CompetitionBadgeRepository implements CompetitionBadgeRepositoryInterface
{

    public function create($data)
    {
    
        $competitionBadge = new CompetitionBadge;
        $competitionBadge->fill($data);
        $competitionBadge->save();

    }    

    public function deleteCompetitionBadges($competitionId)
    {

        CompetitionBadge::where('competition_id', $competitionId)->delete();

    }

}