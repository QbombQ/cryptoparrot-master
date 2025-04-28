<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeConditionServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeConditionFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\Common\TradeConditionValidatorInterface;
use App\Model\Contracts\Interfaces\Data\TradeConditionRepositoryInterface;

class TradeConditionService implements TradeConditionServiceInterface
{

    protected $tradeConditionRepository;
    protected $tradeConditionFormatter;
    protected $tradeConditionValidator;

    public function __construct(
        TradeConditionRepositoryInterface $tradeConditionRepository,
        TradeConditionFormatterInterface $tradeConditionFormatter,
        TradeConditionValidatorInterface $tradeConditionValidator
    )
    {

        $this->tradeConditionRepository = $tradeConditionRepository;
        $this->tradeConditionFormatter = $tradeConditionFormatter;
        $this->tradeConditionValidator = $tradeConditionValidator;

    }

    public function create($data)
    {

        if(
            $this->tradeConditionValidator->validate($data) &&
            array_key_exists('trade_id', $data) && (array_key_exists('below_limit', $data) || array_key_exists('above_limit', $data))
        )
        {

            return $this->tradeConditionRepository->create(
                $this->tradeConditionFormatter->prepareForCreate($data)
            );

        }

    }

    public function update($data)
    {

        if(
            $this->tradeConditionValidator->validate($data) && 
            (array_key_exists('trade_id', $data) && (array_key_exists('below_limit', $data) || array_key_exists('above_limit', $data)))
         )
         {

            return $this->tradeConditionRepository->update(
                $data['trade_id'],
                $this->tradeConditionFormatter->prepareForCreate($data)
            );
            
        }

    }

    public function get($tradeId)
    {

        return $this->tradeConditionFormatter->prepareForDisplay($this->tradeConditionRepository->get($tradeId));

    }

}