<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface CompetitionFormatterInterface
{

    public function prepareCompetitionsForDisplay($competitions);

    public function prepareDataForCreation($data);

    public function prepareDataForUpdate($data);

    public function prepareDataForLogoUpdate($path);

    public function prepareCompetitionForEdit($competition);

    public function prepareCompetitionsForSelect($competitions);

}