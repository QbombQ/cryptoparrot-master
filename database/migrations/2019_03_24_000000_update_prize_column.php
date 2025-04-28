<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePrizeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('competitions', function($table)
        {

            $table->text('prize')->nullable()->change();

        });

    }

    /**
     * Reverse the migrations.
     *creat
     * @return void
     */
    public function down()
    {

    }
}
