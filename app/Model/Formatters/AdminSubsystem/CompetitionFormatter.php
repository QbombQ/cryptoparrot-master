<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\CompetitionFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\CompetitionPrizeFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CompetitionFormatter implements CompetitionFormatterInterface
{

    private $competitionPrizeFormatter;

    public function __construct(
        CompetitionPrizeFormatterInterface $competitionPrizeFormatter
    )
    {

        $this->competitionPrizeFormatter = $competitionPrizeFormatter;

    }

    public function prepareCompetitionsForDisplay($competitions)
    {

        $results = [
            'competitions' => [],
            'pagination' => ''
        ];

        if($competitions instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($competitions);

        }        

        if($competitions->count() > 0)
        {

            foreach($competitions as $competition)
            {

                $results['competitions'][] = [
                    'id' => $competition->id,
                    'title' => $competition->title,
                    'start_date' => $competition->start_date ? Carbon::parse($competition->start_date)->format('j M, Y') : null,
                    'end_date' => $competition->end_date ? Carbon::parse($competition->end_date)->format('j M, Y') : null
                ];

            }

        }

        return $results;

    }
 
    public function prepareDataForCreation($data)
    {

        return [
            'title' => $data['title'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'description' => $data['description'],
            'prize' => $data['prize'],
            'password' => $data['password'],
            'geo' => $data['geo'],
            'logo' => null,
            'cover' => null,
            'is_private' => $data['is_private'] == 'on' ? 1 : 0
        ];

    }

    public function prepareDataForUpdate($data)
    {

        return [
            'title' => $data['title'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'description' => $data['description'],
            'prize' => $data['prize'],
            'password' => $data['password'],
            'geo' => $data['geo'], 
            'is_private' => $data['is_private'] == 'on' ? 1 : 0
        ];

    }    

    public function prepareCompetitionForEdit($competition)
    {

        $data = [
            'id' => $competition->id,
            'title' => $competition->title,
            'start_date' => $competition->start_date ? Carbon::parse($competition->start_date)->toDateTimeString() : null,
            'end_date' => $competition->end_date ? Carbon::parse($competition->end_date)->toDateTimeString() : null,
            'badges' => $competition->badges->pluck('id')->toArray(),
            'description' => $competition->description,
            'prize' => $competition->prize,
            'password' => $competition->password,
            'geo' => $competition->geo,
            'is_private' => $competition->is_private,
            'logo' => Storage::disk('public')->url($competition->logo),
            'cover' => Storage::disk('public')->url($competition->cover),
        ];
 
        $data['prizes'] = $this->competitionPrizeFormatter->preparePrizesForEdit($competition->prizes);

        return $data;

    }

    public function prepareDataForLogoUpdate($path)
    {

        return [
            'logo' => $path
        ];

    } 


    public function prepareDataForCoverUpdate($path)
    {

        return [
            'cover' => $path
        ];

    }        

    public function prepareCompetitionsForSelect($competitions)
    {

        $result = [];

        if($competitions->count() > 0)
        {

            foreach($competitions as $competition)
            {

                $result[$competition->id] = $competition->title;

            }
            
        }

        return $result;

    }

}