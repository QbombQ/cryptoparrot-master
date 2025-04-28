<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscordToMethodsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::statement("INSERT INTO pg_enum (enumtypid, enumlabel, enumsortorder) SELECT 'user_methods'::regtype::oid, 'discord', ( SELECT MAX(enumsortorder) + 1 FROM pg_enum WHERE enumtypid = 'user_methods'::regtype );");
        //DB::statement("ALTER TABLE users DROP CONSTRAINT users_method_check, ADD  CONSTRAINT users_method_check CHECK (method::text = ANY (ARRAY['email'::character varying::text, 'twitter'::character varying::text, 'facebook'::character varying::text, 'google'::character varying::text, 'reddit'::character varying::text, 'steemit'::character varying::text, 'discord'::character varying::text]));");
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
