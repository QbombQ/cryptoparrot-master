<?php

use Illuminate\Database\Seeder;

class SponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'title' => 'Sponsor 1',
                'logo' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]                   
        ];
        foreach($sponsors as $sponsor) {
            DB::table('sponsors')->insert($sponsor);
        }
    }
}
