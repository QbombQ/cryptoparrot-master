<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSteemitToMethodColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP TYPE IF EXISTS user_methods;");
        DB::statement("CREATE TYPE user_methods AS ENUM ('email', 'twitter', 'facebook', 'google', 'reddit', 'steemit');");
        DB::statement("ALTER TABLE users ALTER COLUMN method TYPE user_methods USING (method::user_methods);");
        DB::statement("ALTER TABLE users DROP CONSTRAINT users_method_check, ADD  CONSTRAINT users_method_check CHECK (method::text = ANY (ARRAY['email'::character varying::text, 'twitter'::character varying::text, 'facebook'::character varying::text, 'google'::character varying::text, 'reddit'::character varying::text, 'steemit'::character varying::text]));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
