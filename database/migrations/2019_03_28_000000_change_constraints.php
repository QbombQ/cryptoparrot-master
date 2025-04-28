<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('trade_votes', function($table)
        {

            $table->dropForeign('trade_votes_user_id_foreign');
            $table->dropForeign('trade_votes_trade_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change(); 
            $table->foreign('trade_id')->references('id')->on('trades')->onDelete('cascade')->change(); 

        });

        Schema::table('trade_comments', function($table)
        {

            $table->dropForeign('trade_comments_user_id_foreign');
            $table->dropForeign('trade_comments_trade_id_foreign');
            $table->dropForeign('trade_comments_reply_to_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change(); 
            $table->foreign('reply_to')->references('id')->on('trade_comments')->onDelete('cascade')->change(); 
            $table->foreign('trade_id')->references('id')->on('trades')->onDelete('cascade')->change(); 

        });

        Schema::table('trade_comment_votes', function($table)
        {

            $table->dropForeign('trade_comment_votes_user_id_foreign');
            $table->dropForeign('trade_comment_votes_comment_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change(); 
            $table->foreign('comment_id')->references('id')->on('trade_comments')->onDelete('cascade')->change(); 

        });

        Schema::table('trade_conditions', function($table)
        {

            $table->dropForeign('trade_conditions_trade_id_foreign');
            $table->foreign('trade_id')->references('id')->on('trades')->onDelete('cascade')->change(); 

        });

        Schema::table('trade_fees', function($table)
        {

            $table->dropForeign('trade_fees_trade_id_foreign');
            $table->foreign('trade_id')->references('id')->on('trades')->onDelete('cascade')->change(); 

        });

        Schema::table('newsletter_messages', function($table)
        {

            $table->dropForeign('newsletter_messages_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change(); 

        });

        Schema::table('user_earn_play_dollars', function($table)
        {

            $table->dropForeign("user_earn_play_dollars_earn_play_dollars_id_foreign");
            $table->foreign('earn_play_dollars_id')->references('id')->on('earn_play_dollars')->onDelete('set null')->change(); 

        });

        Schema::table('conversations', function($table)
        {

            $table->dropForeign("conversations_initiator_id_foreign");
            $table->dropForeign("conversations_recipient_id_foreign");
            $table->foreign('initiator_id')->references('id')->on('users')->onDelete('cascade')->change(); 
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade')->change(); 

        });

        Schema::table('conversation_messages', function($table)
        {

            $table->dropForeign("conversation_messages_conversation_id_foreign");
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade')->change(); 

        });

        Schema::table('article_comments', function($table)
        {

            $table->dropForeign('article_comments_user_id_foreign');
            $table->dropForeign('article_comments_article_id_foreign');
            $table->dropForeign('article_comments_reply_to_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change(); 
            $table->foreign('reply_to')->references('id')->on('article_comments')->onDelete('cascade')->change(); 
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade')->change(); 

        });

        Schema::table('article_comment_votes', function($table)
        {

            $table->dropForeign('article_comment_votes_user_id_foreign');
            $table->dropForeign('article_comment_votes_comment_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change(); 
            $table->foreign('comment_id')->references('id')->on('article_comments')->onDelete('cascade')->change(); 

        });

        Schema::table('user_balances', function($table)
        {

            $table->dropForeign('user_balances_portfolio_id_foreign');
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade')->change(); 

        });

        Schema::table('rewards', function($table)
        {

            $table->dropForeign('rewards_sponsor_id_foreign');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('set null')->change();

        });

        Schema::table('user_rewards', function($table)
        {

            $table->dropForeign('user_rewards_reward_id_foreign');
            $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('set null')->change();

        });

    }

    /**
     * Reverse the migrations.
     *creat
     * @return void
     */
    public function down()
    {

    }
}
