<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->double('price')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('info')->nullable();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->integer('sponsor_id')->unsigned()->nullable();
            $table->foreign('sponsor_id')->references('id')->on('sponsors'); 
            $table->integer('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
}
