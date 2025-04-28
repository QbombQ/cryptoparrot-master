<?php 

namespace App\Model\Formatters\FrontSubsystem;

use App\Model\Contracts\Interfaces\Formatters\FrontSubsystem\ArticleFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use PaginateRoute;
use Illuminate\Support\Facades\Hash;
use Avatar;
use Pagination;

class ArticleFormatter implements ArticleFormatterInterface
{

    public function prepareArticlesForDisplay($articles)
    {

        $results = [];
        $results['data'] = [];
        $results['relLinks'] = '';

        if($articles instanceof LengthAwarePaginator) 
        {

            $results['pagination'] = Pagination::defaultPagination($articles);

        }        

        if(!$articles->isEmpty())
        {

            foreach($articles as $article) 
            {

                $results['data'][] = $this->prepareArticleForDisplay($article);

            }

        }

        return $results;

    }

    public function prepareArticleForDisplay($article)
    {

       
        $firstCategory = $article->categories->first();
        
        return [
            'id' => $article->id,
            'title' => $article->title,
            'excerpt' => $article->excerpt,
            'url' => $article->url,
            'slug' => $article->slug,
            'status' => $article->status,
            'author' => $article->author ? $article->author->username : '',
            'authorSlug' => $article->author ? $article->author->handle : '',
            'authorDescription' => $article->author ? $article->author->description : '',
            'authorAvatar' => $article->author ? $article->author->avatar ? 
                                Storage::disk('public')->url($article->author->avatar) :
                                Avatar::create($article->author->username)->setDimension(256, 256)->setFontSize(130)->toBase64() : null,
            'content' => $article->content,
            'thumbnail' => Storage::disk('public')->url($article->thumbnail),
            'date' => $article->created_at->format('j M, Y'),
            'meta_title' => $article->meta_title,
            'meta_description' => $article->meta_description,
            'og_image' => $article->og_image,
            'categories' => $article->categories->pluck('id')->toArray(),
            'categorySlug' => $firstCategory ? $firstCategory->slug : null,
            'categoryTitle' => $firstCategory ? $firstCategory->title : null
        ];

    }    
    
}