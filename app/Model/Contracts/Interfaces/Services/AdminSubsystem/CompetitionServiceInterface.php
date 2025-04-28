<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface CompetitionServiceInterface
{

    public function paginate($limit);

    public function create($data);

    public function update($data);

    public function register($data);

    public function getForEdit($competitionId);

    public function getForSelect();

}