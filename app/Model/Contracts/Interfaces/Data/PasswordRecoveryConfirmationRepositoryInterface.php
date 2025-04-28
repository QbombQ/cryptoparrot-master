<?php

namespace App\Model\Contracts\Interfaces\Data;

interface PasswordRecoveryConfirmationRepositoryInterface
{

    public function createToken($userId, $token);

    public function get($token);  
    
    public function delete($token);

}