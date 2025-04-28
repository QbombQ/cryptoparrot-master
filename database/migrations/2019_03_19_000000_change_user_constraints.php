<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('portfolios', function($table)
        {

            $table->dropForeign('portfolios_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change(); 

        });

        Schema::table('users', function($table) {

            $table->dropForeign('users_main_portfolio_id_foreign');
            $table->dropForeign('users_current_portfolio_id_foreign');
            $table->foreign('main_portfolio_id')->references('id')->on('portfolios')->onDelete('set null')->change(); 
            $table->foreign('current_portfolio_id')->references('id')->on('portfolios')->onDelete('set null')->change(); 

        });

        Schema::table('user_balances', function($table)
        {

            $table->dropForeign('user_balances_portfolio_id_foreign');
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade')->change();

        });

        Schema::table('trades', function($table)
        {

            $table->dropForeign('trades_portfolio_id_foreign');
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade')->change();

        });

        Schema::table('competition_participants', function($table)
        {

            $table->dropForeign('competition_participants_portfolio_id_foreign');
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade')->change();

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
