<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface UserFormatterInterface
{

    public function prepareUsersForDisplay($users);

    public function prepareUserForEditDisplay($user);

    public function prepareRequestDataForUpdate($userBeforeUpdate, $data);

    public function prepareUsersForSelect($users);

    public function prepareUserForMainPortfolioUpdate($portfolioId);

    public function prepareUserForCurrentPortfolioUpdate($portfolioId);

    public function prepareUserActivityForDisplay($usersFromCache);

}