<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface TradePairServiceInterface
{

    public function paginate($perPage);

    public function create($args);

    public function getForEdit($pairId);

    public function update($data);

}