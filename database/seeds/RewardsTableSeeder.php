<?php

use Illuminate\Database\Seeder;

class RewardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rewards = [
            [
                'title' => 'T-shirt',
                'price' => 10000,
                'quantity' => 10,
                'description' => 'Prize description',
                'sponsor_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ];
        foreach($rewards as $reward) {
            DB::table('rewards')->insert($reward);
        }  
    }
}
