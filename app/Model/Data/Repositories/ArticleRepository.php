<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\ArticleRepositoryInterface;
use App\Model\Data\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface
{

    public function paginate($limit)
    {

		$article = new Article;
		$query = $article->newQuery();        

        $query
            ->join('article_article_categories', 'article_article_categories.article_id', '=', 'articles.id')
            ->join('article_categories', 'article_article_categories.article_category_id', '=', 'article_categories.id')
            ->select('articles.*')
            ->where('article_categories.slug', '!=', 'community')
            ->where('articles.status', '=', 'published')
            ->groupBy('articles.id');

        if(isset($_GET['tag']))
        {

            $query->where('articles.tags', 'like', '%'.$_GET['tag'].'%');

        }

        return $query->orderBy('created_at', 'desc')->paginate($limit)->onEachSide(0);

    }

    public function getLatestArticles($offset) 
    {

        $article = new Article;
        $query = $article->newQuery();        

        $query
            ->join('article_article_categories', 'article_article_categories.article_id', '=', 'articles.id')
            ->join('article_categories', 'article_article_categories.article_category_id', '=', 'article_categories.id')
            ->select('articles.*')
            ->where('article_categories.slug', '!=', 'community')
            ->where('articles.status', '=', 'published');

        $offset = ($offset - 1) * 2;

        return $query->orderBy('created_at', 'desc')->offset($offset)->limit(2)->get(); 

    }


    public function paginateAll($limit)
    {

        $article = new Article;
		$query = $article->newQuery();  

        if(isset($_GET['keyword']))
        {

            $query->where('title', 'ilike', '%'.$_GET['keyword'].'%')
                  ->orWhereHas('author', function ($query) {
                    $query->where('username', 'ilike', '%'.$_GET['keyword'].'%');
                  });

        }

		return $query->orderBy('created_at', 'desc')->paginate($limit)->onEachSide(0);

    }    

    public function paginateCategoryArticles($categorySlug, $limit)
    {

		$article = new Article;
		$query = $article->newQuery();        

        $query
            ->join('article_article_categories', 'article_article_categories.article_id', '=', 'articles.id')
            ->join('article_categories', 'article_article_categories.article_category_id', '=', 'article_categories.id')
            ->select('articles.*')
            ->where('article_categories.slug', $categorySlug);

        return $query->orderBy('created_at', 'desc')->paginate($limit)->onEachSide(0);

    }    

    public function getCategoryArticles($categorySlug, $limit)
    {

		$article = new Article;
		$query = $article->newQuery();        

        $query
            ->join('article_article_categories', 'article_article_categories.article_id', '=', 'articles.id')
            ->join('article_categories', 'article_article_categories.article_category_id', '=', 'article_categories.id')
            ->select('articles.*')
            ->where('article_categories.slug', $categorySlug);

        return $query->orderBy('created_at', 'desc')->limit($limit)->get();

    }    
    
    public function getCategoryArticlesByIds($ids, $articleId, $limit)
    {

		$article = new Article;
		$query = $article->newQuery();        

        $query
            ->join('article_article_categories', 'article_article_categories.article_id', '=', 'articles.id')
            ->join('article_categories', 'article_article_categories.article_category_id', '=', 'article_categories.id')
            ->select('articles.*')
            ->where('articles.id', '!=', $articleId)
            ->whereIn('article_categories.id', $ids);

        return $query->orderBy('created_at', 'desc')->paginate($limit)->onEachSide(0);

    }     

    public function getBySlug($slug)
    {

        return Article::where('slug', $slug)->firstOrFail();

    }    


    public function getById($id)
    {

        return Article::findOrFail($id);

    }       

    public function create($args)
    {

        $article = new Article;
        $article->fill($args);
        $article->save();

        return $article->id;

    }

    public function update($articleId, $data)
    {

        $article = Article::find($articleId);

        if($article)
        {

            $article->fill($data);
            $article->save();

        }

    }    

    public function delete($articleId)
    {

        $article = Article::find($articleId);

        if($article)
        {

            $article->delete();
            return true;

        }
        
        return false;

    }    

}