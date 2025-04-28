<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPortfoliosRelatedFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function($table)
        {

            $table->integer('main_portfolio_id')->unsigned()->nullable();
            $table->foreign('main_portfolio_id')->references('id')->on('portfolios');

        });

        Schema::table('user_balances', function($table)
        {

            $table->integer('portfolio_id')->unsigned()->nullable();
            $table->foreign('portfolio_id')->references('id')->on('portfolios');

        });

        Schema::table('trades', function($table)
        {

            $table->integer('portfolio_id')->unsigned()->nullable();
            $table->foreign('portfolio_id')->references('id')->on('portfolios');

        });

        Schema::table('competition_participants', function($table)
        {

            $table->integer('portfolio_id')->unsigned()->nullable();
            $table->foreign('portfolio_id')->references('id')->on('portfolios');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function($table) {

            $table->dropColumn('main_portfolio_id');

        });

        Schema::table('user_balances', function($table) {

            $table->dropColumn('portfolio_id');

        });

        Schema::table('trades', function($table) {

            $table->dropColumn('portfolio_id');

        });

        Schema::table('competition_participants', function($table) {

            $table->dropColumn('portfolio_id');

        });

    }
}
