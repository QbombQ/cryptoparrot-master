<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_subscriptions', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('plan_id')->unsigned()->nullable();
            $table->foreign('plan_id')->references('id')->on('stripe_plans')->onDelete('cascade');   
			$table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
			$table->integer('patron_id')->unsigned()->nullable();
            $table->foreign('patron_id')->references('id')->on('users')->onDelete('cascade');                              
            $table->string('stripe_subscription_id')->nullable()->unique();  
            $table->string('stripe_shared_customer_id')->nullable()->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('period_end');
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
        Schema::dropIfExists('stripe_subscriptions');
    }
}
