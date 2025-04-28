<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\ArticleCategoryRepositoryInterface;
use App\Model\Data\Models\ArticleCategory;

class ArticleCategoryRepository implements ArticleCategoryRepositoryInterface
{

    public function all()
    {

        return ArticleCategory::all();

    }

    public function create($data)
    {

        $articleCategory = new ArticleCategory;
        $articleCategory->fill($data);
        $articleCategory->save();

    }

    public function update($id, $data)
    {

        $articleCategory = ArticleCategory::findOrFail($id);
        $articleCategory->fill($data);
        $articleCategory->save();

    }

    public function get($id)
    {

        return ArticleCategory::findOrFail($id);

    }

    public function getBySlug($slug)
    {

        return ArticleCategory::where('slug', '=' ,$slug)->firstOrFail();

    } 

    public function delete($categoryId)
    {

        $category = ArticleCategory::find($categoryId);

        if($category)
        {

            $category->delete();
            
            return true;

        }
        
        return false;

    }    

}