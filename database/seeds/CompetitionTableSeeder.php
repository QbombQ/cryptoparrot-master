<?php

use Illuminate\Database\Seeder;

class CompetitionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $competitions = [
            [
                'title' => 'Niffler.co Early Adopter Top Trader Competition',
                'start_date' => \Carbon\Carbon::create(2018, 10, 1, 0, 0, 0, 'America/Toronto'),
                'end_date' => \Carbon\Carbon::create(2018, 10, 12, 0, 0, 0, 'America/Toronto'),
                'prize' => '$500 in crypto',
                'description' => 'Niffler.co - Early Adopter Top Trader Competition. The Top Trader for this competition will be awarded $500 in the crypto of their choice. 150 participants are needed for this competition to start.',
                'logo' => 'images/seeder/niffler-logo.png',
                'status' => 2, 
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Start in 10 minutes',
                'start_date' => \Carbon\Carbon::now()->addMinutes(1)->toDateTimeString(),
                'end_date' => \Carbon\Carbon::now()->addMinutes(60)->toDateTimeString(),
                'prize' => '$500 in crypto',
                'description' => 'Niffler.co - Early Adopter Top Trader Competition. The Top Trader for this competition will be awarded $500 in the crypto of their choice. 150 participants are needed for this competition to start.',
                'logo' => 'images/seeder/niffler-logo.png',
                'status' => 0, 
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()                
            ]                               
        ];
        foreach($competitions as $competition) {
            DB::table('competitions')->insert($competition);
        }          
    }
}
