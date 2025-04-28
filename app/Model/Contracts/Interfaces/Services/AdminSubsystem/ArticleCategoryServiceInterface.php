<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface ArticleCategoryServiceInterface
{

    public function getForSelect();

    public function getForEdit($categoryId);

    public function paginate($perPage);

    public function create($data);

    public function update($data);

    public function delete($categoryId);

}