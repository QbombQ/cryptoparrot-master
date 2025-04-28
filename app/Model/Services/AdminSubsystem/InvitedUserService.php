<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\InvitedUserServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\InvitedUserFormatterInterface;
use App\Model\Contracts\Interfaces\Data\InvitedUserRepositoryInterface;

class InvitedUserService implements InvitedUserServiceInterface
{

    protected $invitedUserRepository;
    protected $invitedUserFormatter;

    public function __construct(
        InvitedUserRepositoryInterface $invitedUserRepository,
        InvitedUserFormatterInterface $invitedUserFormatter
    )
    {
        $this->invitedUserRepository = $invitedUserRepository;
        $this->invitedUserFormatter = $invitedUserFormatter;
    }

    public function paginate($perPage)
    {

        $invitedUsers = $this->invitedUserRepository->paginate($perPage);
        
        return $this->invitedUserFormatter->prepareInvitedUsersForDisplay($invitedUsers);

    }

}