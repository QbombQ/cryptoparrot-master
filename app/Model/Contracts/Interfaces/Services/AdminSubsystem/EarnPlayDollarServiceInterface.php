<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface EarnPlayDollarServiceInterface
{

    public function paginate($limit);

    public function create($data);

    public function edit($data);

    public function getForEdit($earnPlayDollarId);

    public function delete($earnPlayDollarId);

}