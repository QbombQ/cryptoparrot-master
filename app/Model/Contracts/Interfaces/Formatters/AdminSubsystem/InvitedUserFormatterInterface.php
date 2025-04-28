<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface InvitedUserFormatterInterface
{

    public function prepareInvitedUsersForDisplay($invitedUsers);

}