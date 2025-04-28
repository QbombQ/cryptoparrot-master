<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePortfolioValuesFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('users', function($table) {
            $table->dropColumn('portfolio_value_in_usd');
            $table->dropColumn('starting_portfolio_value_in_usd');
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
            $table->double('portfolio_value_in_usd')->default(0);
            $table->double('starting_portfolio_value_in_usd')->default(0);
        });
    }
}
