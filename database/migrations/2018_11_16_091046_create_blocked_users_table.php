<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_users', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('blocked_by')->unsigned()->nullable();
            $table->foreign('blocked_by')->references('id')->on('users')->onDelete('cascade');  
			$table->integer('blocked_user_id')->unsigned()->nullable();
            $table->foreign('blocked_user_id')->references('id')->on('users')->onDelete('cascade');               
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
        Schema::dropIfExists('blocked_users');
    }
}
