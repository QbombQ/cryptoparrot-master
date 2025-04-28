<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface CompetitionPrizeServiceInterface
{

    public function create($args);

    public function deleteByCompetitionId($competitionId);

}