<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentPortfolioIdColumn extends Migration
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

            $table->integer('current_portfolio_id')->unsigned()->nullable();
            $table->foreign('current_portfolio_id')->references('id')->on('portfolios');

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

            $table->dropColumn('current_portfolio_id');

        });

    }
}
