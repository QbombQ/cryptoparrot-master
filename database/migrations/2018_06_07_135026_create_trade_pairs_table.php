<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradePairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_pairs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_currency_id')->unsigned()->nullable();
            $table->foreign('from_currency_id')->references('id')->on('currencies');
            $table->integer('to_currency_id')->unsigned()->nullable();
            $table->foreign('to_currency_id')->references('id')->on('currencies'); 
            $table->double('rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade_pairs');
    }
}
