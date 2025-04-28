<?php

use Illuminate\Database\Seeder;

class EarnPlayDollarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $earnPlayDollars = [
            [
                'title' => 'Invited user',
                'price' => 10000,
                'quantity' => 50,
                'description' => 'desc',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]                   
        ];
        foreach($earnPlayDollars as $earnPlayDollar) {
            DB::table('earn_play_dollars')->insert($earnPlayDollar);
        }  
    }
}
