<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface TokenServiceInterface
{

    public function generateUserRegistrationToken($user);

    public function generatePasswordRecoverToken($user);

}