<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDifferentPricesForBuySell extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_pairs', function (Blueprint $table) {
            $table->double('rate_sell')->default(1);
            $table->double('change_sell')->default(0);
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade_pairs', function (Blueprint $table) {
            //
        });
    }
}
