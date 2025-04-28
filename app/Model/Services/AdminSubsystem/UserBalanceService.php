<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserBalanceServiceInterface;
use App\Model\Contracts\Interfaces\Data\UserBalanceRepositoryInterface;

class UserBalanceService implements UserBalanceServiceInterface
{

    private $userBalanceRepository;

    public function __construct(
        UserBalanceRepositoryInterface $userBalanceRepository
    )
    {

        $this->userBalanceRepository = $userBalanceRepository;
            
    }

    public function updateUserBalancePortfolio($userBalanceId, $portfolioId)
    {

        $this->userBalanceRepository->update(
            $userBalanceId,
            [
                'portfolio_id' => $portfolioId
            ]
        );

    }

}