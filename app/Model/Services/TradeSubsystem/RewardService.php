<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\RewardServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\RewardFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\Common\RewardValidatorInterface;
use App\Model\Contracts\Interfaces\Data\RewardRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserRewardsRepositoryInterface;
use Currency;

class RewardService implements RewardServiceInterface
{

    protected $rewardRepository;
    protected $userRewardRepository;
    protected $rewardFormatter;
    protected $rewardValidator;

    public function __construct(
        RewardFormatterInterface $rewardFormatter,
        RewardRepositoryInterface $rewardRepository,
        UserRewardsRepositoryInterface $userRewardRepository,
        RewardValidatorInterface $rewardValidator
    )
    {

        $this->userRewardRepository = $userRewardRepository;
        $this->rewardRepository = $rewardRepository;
        $this->rewardFormatter = $rewardFormatter;
        $this->rewardValidator = $rewardValidator;

    }

    public function paginate()
    {

        $rewards = $this->rewardRepository->paginate();

        return $this->rewardFormatter->prepareRewardsForDisplay($rewards);

    }

    public function amountLeft($user)
    {

        if(!$user) 
        {
            
            return 0;

        }

        $dollarCurrency = Currency::dollar();
        $eligibleAmount = $this->eligibleAmount($user);

        $dollarBalance = 
            $user->mainPortfolio->balances->where('currency_id', $dollarCurrency->id)->first()->amount -
            $user->mainPortfolio->balances->where('currency_id', $dollarCurrency->id)->first()->reserved_amount;
        
        if($eligibleAmount >= $dollarBalance) $redeemable = $dollarBalance;   
        else {
            $redeemable = $eligibleAmount;
        }
 
        $amountLeft = (int) $redeemable;

        return $amountLeft < 0 ? 0 : $amountLeft;

    }

    public function eligibleAmount($user)
    {

        $eligibleAmount = $user->mainPortfolio->portfolio_value_in_usd - $user->mainPortfolio->start_portfolio_value_in_usd;
 
        return $eligibleAmount;
        
    }

    public function buy($user, $data)
    {

        if(!$this->rewardValidator->validateCreation($data))
        {

            return $this->rewardFormatter->prepareCreationFailResponse($this->rewardValidator->getErrors()->errors()->first());

        }

        $data['price'] = $this->rewardRepository->get($data['reward_id'])->price;

        $this->userRewardRepository->create(
            $this->rewardFormatter->prepareForCreation($data)
        );

        return $this->rewardFormatter->prepareCreationSuccessResponse(trans('TradeSubsystem/success-messages.order-placed'));

    }

    public function myRewards( $user )
    {
        
        return $this->rewardFormatter->prepareMyRewardsForDisplay($user->userRewards);

    }

}