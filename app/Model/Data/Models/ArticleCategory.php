<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ArticleCategory extends Model{

	protected $guarded = ['id'];
	protected $table = 'article_categories';

	public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'fullsource'
            ]
        ];
	}
	
	public function getFullsourceAttribute() {
        if($this->slug) {
            return $this->slug;
        }
        return $this->title;
    }    

}