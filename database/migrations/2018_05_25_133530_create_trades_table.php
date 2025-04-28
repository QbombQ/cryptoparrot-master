<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['sell', 'buy', 'short', 'long']);
            $table->enum('status', ['active', 'open', 'cancelled', 'finished'])->default('active');
            $table->enum('source_type', ['link', 'image', 'trading_view', 'video'])->nullable();
            $table->text('source')->nullable();
            $table->double('amount');
            $table->double('target_price');
            $table->string('description', 255)->nullable();
            $table->integer('public')->default(1);
            $table->integer('leverage')->default(0);
            $table->integer('votes')->default(0);
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('buying_currency_id')->unsigned()->nullable();
            $table->foreign('buying_currency_id')->references('id')->on('currencies');
            $table->integer('paying_with_currency_id')->unsigned()->nullable();
            $table->foreign('paying_with_currency_id')->references('id')->on('currencies');
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
        Schema::dropIfExists('trades');
    }
}
