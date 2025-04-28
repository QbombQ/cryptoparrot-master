<?php

namespace App\Model\Contracts\Interfaces\Data;

interface BadgeRepositoryInterface
{

    public function all();

    public function paginate($limit);

    public function create($data);

    public function update($badgeId, $data);

    public function getById($id);

    public function giveBadge($data);

}