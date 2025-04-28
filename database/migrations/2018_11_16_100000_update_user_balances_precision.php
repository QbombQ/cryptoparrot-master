
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserBalancesPrecision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE user_balances ALTER COLUMN amount TYPE NUMERIC(16,8)');
        DB::statement('ALTER TABLE user_balances ALTER COLUMN reserved_amount TYPE NUMERIC(16,8)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_balances', function($table) {
            $table->double('amount')->default(0)->change();
            $table->double('reserved_amount')->default(0)->change();             
        });        
    }
}