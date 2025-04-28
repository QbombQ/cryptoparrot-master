<?php

use Illuminate\Database\Seeder;

class BadgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $badges = [
            [
                'title' => 'Early Adopter',
                'description'=>'Recognition for being an early adopter and trailblazer on Niffler.co',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => '30 Trades',
                'description'=>'Successfully completed 30 trades',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Competition Winner',
                'description'=>'This user is a former Top Trader Competition winner',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],    
            [
                'title' => 'TRADER',
                'description'=>'This user has met "Proof of Experience" and can earn money helping others learn',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'title' => 'Hot Trader',
                'description'=>'',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Legendary Trader',
                'description'=>'',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Bit Tube Supporter',
                'description'=>'',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'THR Supporter',
                'description'=>'',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]; 
        foreach($badges as $badge) {
            DB::table('badges')->insert($badge);
        }          
    }
}
