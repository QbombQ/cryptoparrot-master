<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\CurrencyServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\CurrencyFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\CurrencyValidatorInterface;
use App\Model\Contracts\Interfaces\Data\CurrencyRepositoryInterface;

class CurrencyService implements CurrencyServiceInterface
{

    protected $currencyRepository;
    protected $currencyFormatter;
    protected $currencyValidator;

    public function __construct(
        CurrencyFormatterInterface $currencyFormatter,
        CurrencyRepositoryInterface $currencyRepository,
        CurrencyValidatorInterface $currencyValidator
    )
    {

        $this->currencyRepository = $currencyRepository;
        $this->currencyFormatter = $currencyFormatter;
        $this->currencyValidator = $currencyValidator;

    }  
    
    public function getCurrenciesForTradePairs()
    {

        $currencies = $this->currencyRepository->all();

        return $this->currencyFormatter->prepareCurrenciesForTradePairsPage($currencies);

    }    

    public function paginate($perPage)
    {

        $currencies = $this->currencyRepository->paginate($perPage);

        return $this->currencyFormatter->prepareCurrenciesForDisplay($currencies);

    }
    
    public function getForEdit($currencyId)
    {

        $currency = $this->currencyRepository->get($currencyId);
        
        return $this->currencyFormatter->prepareForEdit($currency);         

    }    

    public function create($data)
    {

        if(!$this->currencyValidator->validateCreate($data))
        {

            return $this->currencyValidator->getErrors();

        }

        $this->currencyRepository->create(
            $this->currencyFormatter->prepareDataForCreation($data)
        );

        return trans('AdminSubsystem/success-messages.currency-creation-success');

    }   
    
    public function update($data)
    {

        if(!$this->currencyValidator->validateUpdate($data))
        {

            return $this->currencyValidator->getErrors();
            
        }

        $this->currencyRepository->update(
            $data['currency_id'],
            $this->currencyFormatter->prepareDataForUpdate($data)
        );

        return trans('AdminSubsystem/success-messages.currency-update-success');

    }       

}