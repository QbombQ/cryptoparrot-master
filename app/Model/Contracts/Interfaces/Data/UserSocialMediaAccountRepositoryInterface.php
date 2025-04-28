<?php

namespace App\Model\Contracts\Interfaces\Data;

interface UserSocialMediaAccountRepositoryInterface
{

    public function deleteByUserId($userId);

    public function create($userId, $network, $url);

}