<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface BadgeServiceInterface
{

    public function all();

    public function paginate($limit);

    public function create($data);

    public function edit($data);

    public function getForEdit($badgeId);

    public function give($data);

}