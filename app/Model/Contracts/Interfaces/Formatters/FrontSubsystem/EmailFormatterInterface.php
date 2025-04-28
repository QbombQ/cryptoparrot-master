<?php

namespace App\Model\Contracts\Interfaces\Formatters\FrontSubsystem;

interface EmailFormatterInterface
{

    public function prepareEmailsForSharingWithFriends($data);

}