<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BlockedUserServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\BlockedUserFormatterInterface;
use App\Model\Contracts\Interfaces\Data\BlockedUserRepositoryInterface;

class BlockedUserService implements BlockedUserServiceInterface
{

    protected $blockedUserRepository;
    protected $blockedUserFormatter;

    public function __construct(
        BlockedUserFormatterInterface $blockedUserFormatter,
        BlockedUserRepositoryInterface $blockedUserRepository
    )
    {

        $this->blockedUserRepository = $blockedUserRepository;
        $this->blockedUserFormatter = $blockedUserFormatter;

    }

    public function blockUser($blockedBy, $blockedUserId)
    {

        if(!$this->blockedUserRepository->exists($blockedUserId, $blockedBy))
        {

            $this->blockedUserRepository->create(
                $this->blockedUserFormatter->prepareDataForCreate($blockedBy, $blockedUserId)
            );

        }

    }

    public function unBlockUser($blockedBy, $blockedUserId)
    {

        if($this->blockedUserRepository->exists($blockedUserId, $blockedBy))
        {

            $this->blockedUserRepository->delete($blockedUserId, $blockedBy);
            
        }

    }

    public function paginate($userId)
    {

        return $this->blockedUserFormatter->prepareBlockedUsers($this->blockedUserRepository->paginate($userId));

    }

}