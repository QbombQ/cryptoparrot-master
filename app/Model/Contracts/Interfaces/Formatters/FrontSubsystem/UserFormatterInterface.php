<?php

namespace App\Model\Contracts\Interfaces\Formatters\FrontSubsystem;

interface UserFormatterInterface
{

    public function prepareUserDataForRegistration($data);

    public function prepareUserDataForReservation($data);

    public function prepareUserDataForRegistrationSocialNetwork($user, $network);

    public function subsystemUrlByUserType($userType);

    public function prepareDataForCurrentPortfolioUpdate($args);

}