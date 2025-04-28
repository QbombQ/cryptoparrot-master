<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface CompetitionServiceInterface
{

    public function paginate($limit);

    public function participate($competitionId);

    public function get($competitionId);

    public function startCompetitions();

    public function endCompetitions();

    public function updateCompetitionParticipants();

    public function getActiveCompetitionsNot($userId, $portfolioId);

}