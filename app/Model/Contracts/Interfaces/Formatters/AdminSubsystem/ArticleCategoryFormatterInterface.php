<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface ArticleCategoryFormatterInterface
{

    public function prepareCategoriesForSelect($categories);

    public function prepareCategoriesForDisplay($categories);

    public function prepareDataForCreation($data);

    public function prepareDataForUpdate($data);

    public function prepareCategoryForEdit($category);

}