<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_credentials', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned()->nullable()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->string('stripe_customer_id')->unique()->nullable();
            $table->string('stripe_account_id')->unique()->nullable();
            $table->string('stripe_product_id')->unique()->nullable();
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
        Schema::dropIfExists('stripe_credentials');
    }
    
}
