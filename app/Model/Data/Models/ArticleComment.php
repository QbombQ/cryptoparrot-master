<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model{

	protected $guarded = ['id'];
	protected $table = 'article_comments';

	public function author()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'user_id');
    } 
    
    public function article()
    {
        return $this->belongsTo('App\Model\Data\Models\Article', 'article_id');
	}     
	
    public function replies()
    {
        return $this->hasMany('App\Model\Data\Models\ArticleComment', 'reply_to');
    }     

}