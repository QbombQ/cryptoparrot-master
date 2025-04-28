<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface UserFormatterInterface
{

    public function prepareCommonUserDataForTradeSubsystem($user);

    public function prepareUserForProfilePage($user);

    public function prepareUserForSettingsPage($user);

    public function prepareRequestDataForProfileUpdate($data);

    public function prepareRequestDataForPasswordUpdate($data);

    public function prepareRequestDataForAvatarUpdate($data);

    public function prepareRequestDataForCoverUpdate($data);

    public function prepareAvatarPathForDisplaying($path);

    public function prepareCoverPathForDisplaying($path);

    public function prepareUsersForTopTradersPage($users, $criteria);

    public function prepareUsersForTopTradersPageAjax($users, $criteria);

}