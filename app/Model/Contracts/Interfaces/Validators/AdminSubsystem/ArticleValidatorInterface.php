<?php

namespace App\Model\Contracts\Interfaces\Validators\AdminSubsystem;

interface ArticleValidatorInterface
{

    public function validateCreate($data);

    public function validateCategoryCreate($data);

    public function validateCategoryUpdate($data);

    public function validateUpdate($data);

}