<?php

namespace App\Model\Contracts\Interfaces\Data;

interface RewardRepositoryInterface
{

    public function paginate($limit);

    public function get($id);

}