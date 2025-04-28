<?php

use Illuminate\Database\Seeder;

class UserRewardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRewards = [
            /*
            [
                'user_id' => 1,
                'prize_id' => 1,
                'price_paid' => 10000,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 2,
                'prize_id' => 1,
                'price_paid' => 5000,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]    */               
        ];
        foreach($userRewards as $userReward) {
            DB::table('user_rewards')->insert($userReward);
        }
    }
}
