<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserNotificationSettingFormatterInterface;
use Auth;

class UserNotificationSettingFormatter implements UserNotificationSettingFormatterInterface
{

    public function prepareNotificationSettingsForCreate($data)
    {

        return [
            'trade_orders' => $data['trade_orders'] == 'on' ? 1 : 0,
            'comments' => $data['comments'] == 'on' ? 1 : 0,
            'newsletters' => $data['newsletters'] == 'on' ? 1 : 0,
            'signals' => $data['signals'] == 'on' ? 1 : 0,
            'new_follows' => $data['new_follows'] == 'on' ? 1 : 0,
            'votes' => $data['votes'] == 'on' ? 1 : 0,
            'user_id' => Auth::id()
        ];

    }

}