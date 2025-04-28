<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArchiveColumnsToTradesAndHistoricalPortfolioValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trades', function($table)
        {
            $table->integer('archived')->default(0);
        });
        Schema::table('historical_portfolio_values', function($table)
        {
            $table->integer('archived')->default(0);
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trades', function($table) {
            $table->dropColumn('archived');
        });
        Schema::table('historical_portfolio_values', function($table) {
            $table->dropColumn('archived');
        });        
    }
}
