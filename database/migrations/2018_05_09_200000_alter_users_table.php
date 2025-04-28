<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('users', function($table) {
            $table->enum('type', ['trader', 'admin'])->default('trader')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->string('description')->nullable();
            $table->string('handle')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->double('portfolio_value_in_usd')->default(0);
            $table->enum('display_email', ['yes', 'no'])->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('type');
            $table->dropColumn('avatar');
            $table->dropColumn('cover');
            $table->dropColumn('description');
            $table->dropColumn('handle');
            $table->dropColumn('phone');
            $table->dropColumn('location');
            $table->dropColumn('portfolio_value_in_usd');
            $table->dropColumn('display_email');
        });
    }
}
