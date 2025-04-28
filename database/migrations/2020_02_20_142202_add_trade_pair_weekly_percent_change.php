<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTradePairWeeklyPercentChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_pairs', function (Blueprint $table) {
            $table->double('weekly_pct_change')->default(0);
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
            
             $table->dropColumn('weekly_pct_change');

        });
    }
}
 