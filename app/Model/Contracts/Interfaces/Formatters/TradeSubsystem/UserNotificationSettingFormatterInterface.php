<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface UserNotificationSettingFormatterInterface
{

    public function prepareNotificationSettingsForCreate($data);

}