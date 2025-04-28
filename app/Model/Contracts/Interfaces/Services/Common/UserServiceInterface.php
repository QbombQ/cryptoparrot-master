<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface UserServiceInterface
{

    public function create($args);

    public function reserve($userId, $args);

    public function getBySocialId($key);

    public function getById($id);

    public function getByHandle($handle);

    public function getByEmail($email);

    public function confirm($token);

    public function loginWithId($userId);

    public function all();

    public function getUsersForSearch();

    public function resetUser($userId);

    public function canGetTraderBadge($userId, $changes);

    public function updateCurrentPortfolio($args);

}