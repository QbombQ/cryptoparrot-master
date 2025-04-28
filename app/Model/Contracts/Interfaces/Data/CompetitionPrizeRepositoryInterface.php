<?php

namespace App\Model\Contracts\Interfaces\Data;

interface CompetitionPrizeRepositoryInterface
{

    public function create($args);

    public function deleteByCompetitionId($competitionId);

}