<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\EarnPlayDollarServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\EarnPlayDollarFormatterInterface;
use App\Model\Contracts\Interfaces\Data\EarnPlayDollarRepositoryInterface;

class EarnPlayDollarService implements EarnPlayDollarServiceInterface
{

    protected $earnPlayDollarRepository;
    protected $earnPlayDollarFormatter;

    public function __construct(
        EarnPlayDollarFormatterInterface $earnPlayDollarFormatter,
        EarnPlayDollarRepositoryInterface $earnPlayDollarRepository
    )
    {

        $this->earnPlayDollarRepository = $earnPlayDollarRepository;
        $this->earnPlayDollarFormatter = $earnPlayDollarFormatter;

    }

    public function paginate($limit)
    {

        $earnPlayDollars = $this->earnPlayDollarRepository->paginate($limit);

        return $this->earnPlayDollarFormatter->prepareEarnPlayDollarsForDisplay($earnPlayDollars);

    }

}