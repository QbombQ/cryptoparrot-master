<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\ExchangeServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\ExchangeFormatterInterface;
use App\Model\Contracts\Interfaces\Data\ExchangeRepositoryInterface;

class ExchangeService implements ExchangeServiceInterface
{

    protected $exchangeFormatter;
    protected $exchangeRepository;

    public function __construct(
        ExchangeFormatterInterface $exchangeFormatter,
        ExchangeRepositoryInterface $exchangeRepository
    )
    {

        $this->exchangeRepository = $exchangeRepository;
        $this->exchangeFormatter = $exchangeFormatter;

    }

    public function paginate($perPage)
    {

        return $this->exchangeFormatter->prepareExchangesForDisplay(
            $this->exchangeRepository->paginate($perPage)
        );

    }

}