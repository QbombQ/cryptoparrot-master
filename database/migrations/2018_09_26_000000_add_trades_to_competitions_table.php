<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTradesToCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competition_participants', function($table)
        {
            $table->text('start_trades')->nullable();
            $table->text('current_trades')->nullable();
            $table->text('end_trades')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competition_participants', function($table) {
            $table->dropColumn('start_trades');
            $table->dropColumn('current_trades');
            $table->dropColumn('end_trades');
        });        
    }
}
