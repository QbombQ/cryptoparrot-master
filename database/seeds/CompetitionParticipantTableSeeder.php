<?php

use Illuminate\Database\Seeder;

class CompetitionParticipantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $participants = [
            /*
            [
                'user_id' => 1,
                'competition_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],*/
            [
                'user_id' => 2,
                'competition_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],  /*
            [
                'user_id' => 1,
                'competition_id' => 2,
                'portfolio_start_value' => 100000,
                'current_portfolio_value' => 107500,
                'change' => 7.5,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 2,
                'competition_id' => 2,
                'portfolio_start_value' => 50000,
                'current_portfolio_value' => 65000,
                'change' => 30,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],      
            [
                'user_id' => 1,
                'competition_id' => 3,
                'portfolio_start_value' => 100000,
                'current_portfolio_value' => 107500,
                'change' => 7.5,                
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 2,
                'competition_id' => 3,
                'portfolio_start_value' => 50000,
                'current_portfolio_value' => 65000,
                'change' => 30,                
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],                    
            [
                'user_id' => 3,
                'competition_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 4,
                'competition_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ] */                                                          
        ];
        foreach($participants as $participant) {
            DB::table('competition_participants')->insert($participant);
        }          
    }
}
