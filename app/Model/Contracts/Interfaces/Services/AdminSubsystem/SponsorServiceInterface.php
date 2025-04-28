<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface SponsorServiceInterface
{

    public function paginate($limit);

    public function all();

    public function create($data);

    public function edit($data);

    public function getForEdit($sponsorId);

    public function delete($sponsorId);

}