<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\ArticleFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Auth;
use Pagination;

class ArticleFormatter implements ArticleFormatterInterface
{

    public function prepareArticlesForDisplay($articles)
    {

        $results = [
            'articles' => [],
            'pagination' => ''
        ];

        if($articles instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($articles);

        }        

        if($articles->count() > 0)
        {

            foreach($articles as $article)
            {

                $results['articles'][] = [ 
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'url' => $article->url,
                    'internal' => $article->url ? true : false,
                    'date' => $article->updated_at->format('j M, Y'),
                    'meta_title' => $article->meta_title,
                    'meta_description' => $article->meta_description,
                    'status' => $article->status,
                    'og_image' => $article->og_image
                ];

            }

        }

        return $results;

    }

    public function prepareArticleForEdit($article)
    {

        return [
            'author' => $article->user_id,
            'id' => $article->id,
            'title' => $article->title,
            'slug' => $article->slug,
            'excerpt' => $article->excerpt,
            'content' => $article->content,
            'url' => $article->url,
            'tags' => $article->tags,
            'internal' => $article->slug ? true : false,
            'meta_title' => $article->meta_title,
            'meta_description' => $article->meta_description,
            'status' => $article->status,
            'thumbnail' => Storage::disk('public')->url($article->thumbnail),
            'created_at' => $article->created_at,
            'categories' => $article->categories->pluck('id')->toArray()
        ];        

    }    

    public function prepareDataForUpdate($data)
    {

        return [
            'user_id' => array_key_exists('author', $data) && $data['author'] ? $data['author'] : Auth::id(),
            'title' => $data['title'],
            'content' => $data['content'],
            'excerpt' => $data['excerpt'],
            'status' => $data['status'],
            'slug' => array_key_exists('url', $data) ? null : preg_replace('!-+!', '-', $data['slug']),
            'tags' => array_key_exists('tags', $data) ? $data['tags'] : null,
            'url' => array_key_exists('url', $data) ? $data['url'] : null,
            'meta_title' => array_key_exists('meta_title', $data) ? $data['meta_title'] : null,
            'meta_description' => array_key_exists('meta_description', $data) ? $data['meta_description'] : null,
            'created_at' => $data['created_at']
        ];        

    }    

    public function prepareDataForCreation($data)
    {

        return [
            'user_id' => array_key_exists('author', $data) && $data['author'] ? $data['author'] : Auth::id(),
            'title' => $data['title'],
            'content' => $data['content'],
            'excerpt' => $data['excerpt'],
            'status' => $data['status'],
            'slug' => array_key_exists('url', $data) ? null : preg_replace('!-+!', '-', $data['slug']),
            'tags' => array_key_exists('tags', $data) ? $data['tags'] : null,
            'url' => array_key_exists('url', $data) ? $data['url'] : null,
            'thumbnail' => null,
            'meta_title' => array_key_exists('meta_title', $data) ? $data['meta_title'] : null,
            'meta_description' => array_key_exists('meta_description', $data) ? $data['meta_description'] : null
        ];

    }

    public function prepareDataForThumbnailUpdate($path)
    {

        return [
            'thumbnail' => $path
        ];

    }

    public function prepareDataForOgImageUpdate($path)
    {

        return [
            'og_image' => $path
        ];

    }    

}