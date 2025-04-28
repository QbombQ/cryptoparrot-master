<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\PrizeServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\PrizeFormatterInterface;
use App\Model\Contracts\Interfaces\Data\PrizeRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserPrizesRepositoryInterface;
use App\Model\Data\Models\Currency;

class PrizeService implements PrizeServiceInterface
{

    protected $prizeRepository;
    protected $userPrizeRepository;
    protected $prizeFormatter;
    protected $balanceService;

    public function __construct(
        PrizeFormatterInterface $prizeFormatter,
        PrizeRepositoryInterface $prizeRepository,
        UserPrizesRepositoryInterface $userPrizeRepository,
        BalanceServiceInterface $balanceService
    )
    {

        $this->userPrizeRepository = $userPrizeRepository;
        $this->prizeRepository = $prizeRepository;
        $this->prizeFormatter = $prizeFormatter;
        $this->balanceService = $balanceService;

    }

    public function paginate()
    {

        $prizes = $this->prizeRepository->paginate();

        return $this->prizeFormatter->preparePrizesForDisplay($prizes);

    }

    public function amountLeft($user)
    {

        $portfolioChange = $user->mainPortfolio->portfolio_value_in_usd - $user->mainPortfolio->start_portfolio_value_in_usd;
        $amountLeft = $portfolioChange;

        if($amountLeft < 0)
        {

            $amountLeft = 0;

        }

        return $amountLeft;

    }

    public function buy($user, $prizeId)
    {

        $prize = $this->prizeRepository->get($prizeId);

        if(!$prize) return 'Prize does not exist';

        $userAmountLeft = $this->amountLeft($user);

        if($userAmountLeft < $prize->price) return 'Not enough funds.';

        $this->userPrizeRepository->create([
            'user_id' => $user->id,
            'prize_id' => $prize->id,
            'price_paid' => $prize->price
        ]);
        $dollarCurrency = Currency::orderBy('created_at', 'asc')->first();
        $user->earn_play_dollars_reward_diff -= $prize->price;
        $user->save();
        $this->balanceService->addAmount($user->id, $dollarCurrency->id, $user->main_portfolio_id, -1 * $prize->price);
        $this->balanceService->updateUsdValues($user->handle);

        return true;

    }

    public function myPrizes( $user )
    {
        
        return $this->prizeFormatter->prepareMyPrizesForDisplay($user->userPrizes);

    }

}