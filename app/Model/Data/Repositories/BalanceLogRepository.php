<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\BalanceLogRepositoryInterface;
use App\Model\Data\Models\BalanceLog;

class BalanceLogRepository implements BalanceLogRepositoryInterface
{

    public function create($args)
    {

        try {

            $balanceLog = new BalanceLog;
            $balanceLog->fill($args);
            $balanceLog->save();

        }catch(\Exception $e)
        {

            \Log::error($e);

        }

    }

}