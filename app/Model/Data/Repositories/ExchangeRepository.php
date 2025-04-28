<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\ExchangeRepositoryInterface;
use App\Model\Data\Models\Exchange;
use Carbon\Carbon;

class ExchangeRepository implements ExchangeRepositoryInterface
{

    public function getUserExchangeHistory($userId)
    {

        return Exchange::where('user_id', $userId)->orderBy('id', 'desc')->get();

    }

    public function getLastExchange($userId)
    {

        return Exchange::where('user_id', $userId)->latest()->get()->first();

    } 

    public function getExchangedAmountInLast24Hours($userId)
    {

        return Exchange::where('user_id', $userId)->where('created_at', '>=', Carbon::now()->subDay(2))->get()->sum('amount');

    } 
 
    public function getOtherUserExchangesWithMatchingIp($ip,$userId){

        return Exchange::where('user_id','!=',$userId)->where('ip', $ip)->get()->count();

    } 

    public function paginate($perPage)
    {

        return Exchange::orderBy('id', 'desc')->paginate($perPage);

    }

    public function create($args)
    {

        $exchange = new Exchange;
        $exchange->fill($args);
        $exchange->save();

    }

}