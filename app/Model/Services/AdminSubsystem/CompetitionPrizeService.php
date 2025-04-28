<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\CompetitionPrizeServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\CompetitionPrizeFormatterInterface;
use App\Model\Contracts\Interfaces\Data\CompetitionPrizeRepositoryInterface;

class CompetitionPrizeService implements CompetitionPrizeServiceInterface
{

    private $competitionPrizeRepository;
    private $competitionPrizeFormatter;

    public function __construct(
        CompetitionPrizeRepositoryInterface $competitionPrizeRepository,
        CompetitionPrizeFormatterInterface $competitionPrizeFormatter
    )
    {

        $this->competitionPrizeRepository = $competitionPrizeRepository;
        $this->competitionPrizeFormatter = $competitionPrizeFormatter;

    }

    public function create($args)
    {

        $this->competitionPrizeRepository->create(
            $this->competitionPrizeFormatter->prepareDataForCreate($args)
        );

    }

    public function deleteByCompetitionId($competitionId)
    {

        $this->competitionPrizeRepository->deleteByCompetitionId($competitionId);

    }

}