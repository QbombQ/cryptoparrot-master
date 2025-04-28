<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface CompetitionFormatterInterface
{

    public function prepareCompetitionsForDisplay($competitions);

    public function prepareAjaxResponse($success, $message);

    public function prepareCompetitionForInnerDisplay($competition, $competitionLeaders);

    public function prepareCompetitionsForWidget($competitions);

}