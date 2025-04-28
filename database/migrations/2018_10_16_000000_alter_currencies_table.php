<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCurrenciesTable extends Migration
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
            $table->jsonb('links')->nullable();
            $table->text('full_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();            
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
            $table->dropColumn('links');
            $table->dropColumn('full_description');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');            
        });        
    }
}
