<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\InvitedUserRepositoryInterface;
use App\Model\Data\Models\InvitedUser;

class InvitedUserRepository implements InvitedUserRepositoryInterface
{

    public function create($args)
    {

        $invitedUser = new InvitedUser();
        $invitedUser->fill($args);
        $invitedUser->save();

    }

    public function paginate($perPage)
    {

        return InvitedUser::orderBy('updated_at', 'desc')->paginate($perPage);

    }

}