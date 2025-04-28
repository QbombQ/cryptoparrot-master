<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface UserBalanceServiceInterface
{

    public function updateUserBalancePortfolio($userBalanceId, $portfolioId);

}