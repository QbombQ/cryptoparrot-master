<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use App;

class UpdateCompetitions extends Command
{

    protected $signature = 'competitions:update';

    public function handle()
    {

        $competitionService = App::make('App\Model\Contracts\Interfaces\Services\TradeSubsystem\CompetitionServiceInterface');
        $competitionService->updateCompetitionParticipants();

    }



} 