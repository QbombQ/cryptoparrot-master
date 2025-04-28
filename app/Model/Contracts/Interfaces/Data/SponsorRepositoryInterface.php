<?php

namespace App\Model\Contracts\Interfaces\Data;

interface SponsorRepositoryInterface
{

    public function paginate($limit);

    public function create($args);

    public function update($id, $args);

    public function getById($sponsorId);

    public function all();

}