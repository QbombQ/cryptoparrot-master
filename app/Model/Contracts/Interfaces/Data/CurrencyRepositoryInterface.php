<?php

namespace App\Model\Contracts\Interfaces\Data;

interface CurrencyRepositoryInterface
{

    public function getCryptoCurrencies();

    public function updateUsdRate($acronym, $rate);

    public function updateUsdRateAverage($acronym, $rate);

    public function paginate($limit);

    public function create($data);

    public function all();

    public function get($currencyId);

    public function getByAcronym($acronym);

    public function update($currencyId, $data);

}