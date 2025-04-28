<?php

namespace App\Model\Contracts\Interfaces\Data;

interface ExchangeRepositoryInterface
{

	public function getUserExchangeHistory($userId);
	public function getLastExchange($userId);
	public function getExchangedAmountInLast24Hours($userId);
	public function getOtherUserExchangesWithMatchingIp($ip,$userId);
	public function paginate($perPage);
	public function create($data);
	 
} 