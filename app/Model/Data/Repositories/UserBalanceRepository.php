<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\UserBalanceRepositoryInterface;
use App\Model\Data\Models\UserBalance;

class UserBalanceRepository implements UserBalanceRepositoryInterface
{

    public function reset($userId, $portfolioId)
    {

        UserBalance::where('user_id', $userId)->where('portfolio_id', $portfolioId)->update([
            'amount' => 0,
            'reserved_amount' => 0,
            'usd_value' => 0
        ]);

    }

	/**
	 * Increases reserved balance
	 */
    public function reserve($userId, $currencyId, $portfolioId, $amount)
    {

        $balance = UserBalance::where(['user_id' => $userId, 'currency_id' => $currencyId, 'portfolio_id' => $portfolioId])->firstOrCreate(['user_id' => $userId, 'currency_id' => $currencyId, 'portfolio_id' => $portfolioId]);
        $balance->reserved_amount += floatval($amount);
        $balance->save(); 

    }

	/**
	 * Decreases reserved balance
	 */
    public function release($userId, $currencyId, $portfolioId, $amount)
    {

        $balance = UserBalance::where(['user_id' => $userId, 'currency_id' => $currencyId, 'portfolio_id' => $portfolioId])->firstOrCreate(['user_id' => $userId, 'currency_id' => $currencyId, 'portfolio_id' => $portfolioId]);
        $balance->reserved_amount -= floatval($amount);
        $balance->save();

    }    

	/**
	 * Increases balance amount
	 */    
    public function addAmount($userId, $currencyId, $portfolioId, $amount)
    {

        $balance = UserBalance::where(['user_id' => $userId, 'currency_id' => $currencyId, 'portfolio_id' => $portfolioId])->firstOrCreate(['user_id' => $userId, 'currency_id' => $currencyId, 'portfolio_id' => $portfolioId]);
        $balance->amount += floatval($amount);

        if($currencyId == 1)
        {

            $balance->usd_value += floatval($amount);

        }

        $balance->save();

    } 

    public function createIfDoesNotExist($userId, $currencyId, $portfolioId)
    {

        $balance = UserBalance::where(['user_id' => $userId, 'portfolio_id' => $portfolioId, 'currency_id' => $currencyId])->firstOrCreate(['user_id' => $userId, 'portfolio_id' => $portfolioId, 'currency_id' => $currencyId]);
        return $balance->id;

    }    
    
    public function update($balanceId, $data)
    {

        $balance = UserBalance::find($balanceId);

        if($balance)
        {

            $balance->update($data);
            
        }

    }    

}