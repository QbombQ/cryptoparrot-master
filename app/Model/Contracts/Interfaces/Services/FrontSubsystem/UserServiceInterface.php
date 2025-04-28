<?php

namespace App\Model\Contracts\Interfaces\Services\FrontSubsystem;

use Illuminate\Http\Request;

interface UserServiceInterface
{

    public function registerWithEmail(Request $request);

    public function loginWithEmail($request);

    public function loginWithSocialNetwork($network, $user);

    public function reserveHandle(Request $request);

    public function recoverPassword(Request $request);

    public function passwordRecoveryTokenValid($token);

    public function changePassword($request);

    public function getCodeCount($code);

}