<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarketStatusAndIsStockColumnsToTradePairs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_pairs', function (Blueprint $table) {
             $table->integer('market_status')->default(1); 
             $table->integer('is_stock')->default(0); 
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
 