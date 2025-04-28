<?php

namespace App\Model\Contracts\Interfaces\Data;

interface CompetitionBadgeRepositoryInterface
{

    public function create($data);

    public function deleteCompetitionBadges($competitionId);

}