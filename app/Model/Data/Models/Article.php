<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model{

	use Sluggable;

	protected $guarded = ['id'];
	protected $table = 'articles';
	
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'fullsource'
            ]
        ];
    }	

    public function getFullsourceAttribute() {
        if($this->url)
        {
            return null;
        }
        if($this->slug) {
            return $this->slug;
        }
        return $this->title;
    }    

    public function categories()
    {

        return $this->belongsToMany('App\Model\Data\Models\ArticleCategory', 'article_article_categories');
        
    }   
    
    public function author()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'user_id');
    }         

}