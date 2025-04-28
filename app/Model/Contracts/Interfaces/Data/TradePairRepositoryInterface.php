<?php

namespace App\Model\Contracts\Interfaces\Data;

interface TradePairRepositoryInterface
{

    public function all();

    public function getForCurrenciesPage();

    public function getByIds($fromId, $toId);

    public function paginate($limit);

    public function create($limit);

    public function update($id, $data);

}