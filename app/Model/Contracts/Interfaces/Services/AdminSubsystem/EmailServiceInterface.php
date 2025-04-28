<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface EmailServiceInterface
{

    public function sendMassEmail($data);

    public function resendVerification($users);

    public function sendEmailToAdministratorAboutFollow($messages);

    public function sendRetentionEmail($user, $step);

}