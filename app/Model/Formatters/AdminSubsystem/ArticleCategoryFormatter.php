<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\ArticleCategoryFormatterInterface;

class ArticleCategoryFormatter implements ArticleCategoryFormatterInterface
{

    public function prepareCategoriesForSelect($categories)
    {

        $results = [];

        if($categories->count() > 0)
        {

            foreach($categories as $category)
            {

                $results[] = [
                    'value' => $category->id,
                    'label' => $category->title
                ];

            }

        }

        return $results;

    }

    public function prepareCategoriesForDisplay($categories)
    {

        $results['categories'] = [];

        if($categories->count() > 0)
        {

            foreach($categories as $category)
            {

                $results['categories'][] = [
                    'id' => $category->id,
                    'title' => $category->title,
                    'slug' => $category->slug,
                    'meta_title' => $category->meta_title,
                    'meta_description' => $category->meta_description,
                ];
                
            }

        }

        return $results;

    }

    public function prepareDataForCreation($data)
    {

        return [
            'title' => $data['title'],
            'slug' => preg_replace('!-+!', '-', $data['slug']),
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description']
        ];

    }
 
    public function prepareDataForUpdate($data)
    {

        return [
            'title' => $data['title'],
            'slug' => preg_replace('!-+!', '-', $data['slug']),
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description']
        ];

    }

    public function prepareCategoryForEdit($category)
    {

        return [
            'id' => $category->id,
            'title' => $category->title,
            'slug' => $category->slug,
            'meta_title' => $category->meta_title,
            'meta_description' => $category->meta_description
        ];

    }

}