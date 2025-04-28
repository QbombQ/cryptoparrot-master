<?php

namespace App\Model\Contracts\Interfaces\Data;

interface BlockedUserRepositoryInterface
{

    public function create($args);

    public function exists($blockedUserId, $blockedById);

    public function delete($blockedUserId, $blockedById);

    public function paginate($userId);

}