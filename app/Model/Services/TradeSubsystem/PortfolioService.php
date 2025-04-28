<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\PortfolioServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\RewardServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\BalanceFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\PortfolioFormatterInterface;

class PortfolioService implements PortfolioServiceInterface
{

    protected $rewardService;
    protected $balanceFormatter;
    protected $userFormatter;
    protected $portfolioFormatter;

    public function __construct(
        RewardServiceInterface $rewardService,
        BalanceFormatterInterface $balanceFormatter,
        UserFormatterInterface $userFormatter,
        PortfolioFormatterInterface $portfolioFormatter
    )
    {

        $this->rewardService = $rewardService;
        $this->balanceFormatter = $balanceFormatter;
        $this->userFormatter = $userFormatter;
        $this->portfolioFormatter = $portfolioFormatter;

    }

    public function currentPortfolioHtml($user)
    {

        $commonUserData = $this->userFormatter->prepareCommonUserDataForTradeSubsystem($user);
        $userBalances = $this->balanceFormatter->prepareUserBalancesForPortfolioDisplay($user->currentPortfolio->balances->sortBy('id'));
        $amountLeftNoFormat = floatval($this->rewardService->amountLeft($user));
        
        return $this->portfolioFormatter->prepareCurrentPortfolioHtml($user, $commonUserData, $userBalances, $amountLeftNoFormat);

    }

}