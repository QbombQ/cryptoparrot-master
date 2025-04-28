<?php

use Illuminate\Database\Seeder;

class UserEarnPlayDollarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $earnPlayDollars = [
            /*
            [
                'user_id' => 1,
                'reward_id' => 1,
                'price_earned' => 10000,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 2,
                'reward_id' => 1,
                'price_earned' => 100000,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]*/                   
        ];
        foreach($earnPlayDollars as $earnPlayDollar) {
            DB::table('user_earn_play_dollars')->insert($earnPlayDollar);
        }
    }
}
