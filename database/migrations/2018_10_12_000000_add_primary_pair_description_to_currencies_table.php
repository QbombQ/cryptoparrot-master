<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrimaryPairDescriptionToCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currencies', function($table)
        {
            $table->text('description')->nullable();
            $table->integer('primary_pair')->unsigned()->nullable();
            $table->foreign('primary_pair')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('currencies', function($table) {
            $table->dropColumn('description');
            $table->dropColumn('primary_pair');
        });        
    }
}
