<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\PortfolioFormatterInterface;

class PortfolioFormatter implements PortfolioFormatterInterface
{

    public function prepareCurrentPortfolioHtml($user, $commonUserData, $userBalances, $redeemAmountLeft)
    {

        $data['portfolioValue'] = $commonUserData['portfolioValueInUsd'];
        $data['userId'] = $user->id;
        $data['username'] = 'My';
        $data['intro'] = false;
        $data['balances'] = $userBalances;
        $data['commonUserData'] = $commonUserData;
        $data['portfolioValueChangeIn'] = $commonUserData['portfolioValueChangeIn'];
        $data['amountLeftNoFormat'] = $redeemAmountLeft;
        $redeemUpTo = ((floatval($redeemAmountLeft) / 1000.0) * config('custom.satoshi_reward_per_thousand_play_dollars')) / config('custom.play_usd_btc_rate');
        $data['redeemUpTo'] = $redeemUpTo == 0 ? 0.00 : sprintf('%f', $redeemUpTo);
    
        return [
            'html' => view('pages/TradeSubsystem/common/portfolio-card', $data)->render()
        ];

    }

}