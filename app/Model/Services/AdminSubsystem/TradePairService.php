<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\TradePairServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\TradePairFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\TradePairValidatorInterface;
use App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface;

class TradePairService implements TradePairServiceInterface
{

    protected $tradePairRepository;
    protected $tradePairFormatter;
    protected $tradePairValidator;

    public function __construct(
        TradePairFormatterInterface $tradePairFormatter,
        TradePairRepositoryInterface $tradePairRepository,
        TradePairValidatorInterface $tradePairValidator
    )
    {

        $this->tradePairRepository = $tradePairRepository;
        $this->tradePairFormatter = $tradePairFormatter;
        $this->tradePairValidator = $tradePairValidator;

    }    

    public function paginate($perPage)
    {

        $pairs = $this->tradePairRepository->paginate($perPage);

        return $this->tradePairFormatter->preparePairsForDisplay($pairs);

    }

    public function getForEdit($pairId)
    {

        $pairData = $this->tradePairRepository->get($pairId);
        
        return $this->tradePairFormatter->preparePairForEdit($pairData);

    }

    public function create($data)
    {

        if(!$this->tradePairValidator->validateCreate($data))
        {

            return $this->tradePairValidator->getErrors();

        }

        $this->tradePairRepository->create(
            $this->tradePairFormatter->prepareDataForCreation($data)
        );

        return trans('AdminSubsystem/success-messages.tradePair-creation-success');

    }    

    public function update($data)
    {

        if(!$this->tradePairValidator->validateUpdate($data))
        {

            return $this->tradePairValidator->getErrors();
            
        }

        $this->tradePairRepository->update(
            $data['pair_id'],
            $this->tradePairFormatter->prepareDataForUpdate($data)
        );

        return trans('AdminSubsystem/success-messages.tradePair-update-success');

    }    

}