<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\BlockedUserRepositoryInterface;
use App\Model\Data\Models\BlockedUser;

class BlockedUserRepository implements BlockedUserRepositoryInterface
{

    public function create($args)
    {

        $blockedUser = new BlockedUser;
        $blockedUser->fill($args);
        $blockedUser->save();

    }

    public function exists($blockedUserId, $blockedById)
    {

        return BlockedUser::where('blocked_user_id', $blockedUserId)->where('blocked_by', $blockedById)->first();

    }

    public function delete($blockedUserId, $blockedById)
    {

        return BlockedUser::where('blocked_user_id', $blockedUserId)->where('blocked_by', $blockedById)->delete();

    }

    public function paginate($userId)
    {

        return BlockedUser::where('blocked_by', $userId)->paginate(20);

    }

}
