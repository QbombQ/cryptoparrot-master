<?php

namespace App\Model\Contracts\Interfaces\Data;

interface InvitedUserRepositoryInterface
{

    public function create($args);

    public function paginate($perPage);

}