<?php

namespace App\Model\Contracts\Interfaces\Data;

interface CompetitionRepositoryInterface
{

    public function paginate($limit);

    public function create($data);

    public function update($competitionId, $data);

    public function getById($competitionId);

    public function getCompetitionsThatNeedToBeStarted();

    public function getCompetitionsThatNeedToBeFinished();

    public function getOngoingCompetitions();

    public function all();

}