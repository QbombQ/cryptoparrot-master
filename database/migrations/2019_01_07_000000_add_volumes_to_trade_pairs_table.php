<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVolumesToTradePairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_pairs', function($table)
        {
            $table->integer('buy_volume_limit')->default(0);
            $table->integer('sell_volume_limit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade_pairs', function($table) {
            $table->dropColumn('buy_volume_limit');
            $table->dropColumn('sell_volume_limit');
        });
    }
}
