<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface CurrencyServiceInterface
{

    public function paginate($perPage);

    public function create($data);
    
    public function update($data);

    public function getCurrenciesForTradePairs();

    public function getForEdit($currencyId);

}