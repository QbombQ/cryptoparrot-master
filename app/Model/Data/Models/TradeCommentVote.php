<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class TradeCommentVote extends Model{

	protected $guarded = ['id'];
	protected $table = 'trade_comment_votes';

}