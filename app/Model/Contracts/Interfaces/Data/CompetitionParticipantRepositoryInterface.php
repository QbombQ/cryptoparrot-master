<?php

namespace App\Model\Contracts\Interfaces\Data;

interface CompetitionParticipantRepositoryInterface
{

    public function create($data);

    public function userAlreadyParticipates($userId, $competitionId);

    public function getLeaders($competitionId);

    public function getCountUsersThatDoesNotHaveTrades($competitionId, $startDate, $endDate);

    public function getUsersThatDoesNotHaveTrades($competitionId, $startDate, $endDate);

    public function update($participantId, $competitionId, $data);

    public function getParticipant($userId, $competitionId);

    public function getUserCompetitions($userId, $status);

    public function getActiveCompetitionsExceptPortfolio($userId, $portfolioId);

}