<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCommentVote extends Model{

	protected $guarded = ['id'];
	protected $table = 'article_comment_votes';

}