<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUserBalancesUniqueConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('user_balances', function($table) {
            $table->dropUnique('user_balances_user_id_currency_id_unique');
            $table->unique(['portfolio_id', 'currency_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_balances', function($table) {
            $table->unique(['user_id', 'currency_id']);
        });
    }
}


