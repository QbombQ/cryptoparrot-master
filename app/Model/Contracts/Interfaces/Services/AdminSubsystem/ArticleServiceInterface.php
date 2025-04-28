<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface ArticleServiceInterface
{

    public function paginate($perPage);

    public function create($data);

    public function update($data);

    public function delete($articleId);

    public function getForEdit($articleSlug);
    
}