<?php

use Illuminate\Database\Seeder;

class HistoricalPortfolioValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'portfolio_usd_value' => 100000,
                'user_id' => 1,
                'date' => \Carbon\Carbon::now()->subDays(7)
            ],
            [ 
                'portfolio_usd_value' => 100000,
                'user_id' => 1,
                'date' => \Carbon\Carbon::now()->subDays(30)
            ],
            [
                'portfolio_usd_value' => 100000,
                'user_id' => 2,
                'date' => \Carbon\Carbon::now()->subDays(7)
            ],
            [ 
                'portfolio_usd_value' => 100000,
                'user_id' => 2,
                'date' => \Carbon\Carbon::now()->subDays(30)
            ],
            [
                'portfolio_usd_value' => 100000,
                'user_id' => 3,
                'date' => \Carbon\Carbon::now()->subDays(7)
            ],
            [ 
                'portfolio_usd_value' => 100000,
                'user_id' => 3,
                'date' => \Carbon\Carbon::now()->subDays(30)
            ],
            
            
            [
                'portfolio_usd_value' => 100000,
                'user_id' => 4,
                'date' => \Carbon\Carbon::now()->subDays(7)
            ],
            [ 
                'portfolio_usd_value' => 100000,
                'user_id' => 4,
                'date' => \Carbon\Carbon::now()->subDays(30)
            ],
            [
                'portfolio_usd_value' => 100000,
                'user_id' => 5,
                'date' => \Carbon\Carbon::now()->subDays(7)
            ],
            [ 
                'portfolio_usd_value' => 100000,
                'user_id' => 5,
                'date' => \Carbon\Carbon::now()->subDays(30)
            ],
            [
                'portfolio_usd_value' => 100000,
                'user_id' => 6,
                'date' => \Carbon\Carbon::now()->subDays(7)
            ],
            [ 
                'portfolio_usd_value' => 100000,
                'user_id' => 6,
                'date' => \Carbon\Carbon::now()->subDays(30)
            ],
            [
                'portfolio_usd_value' => 100000,
                'user_id' => 7,
                'date' => \Carbon\Carbon::now()->subDays(7)
            ],
            [ 
                'portfolio_usd_value' => 100000,
                'user_id' => 7,
                'date' => \Carbon\Carbon::now()->subDays(30)
            ]                          
        ];
        foreach($values as $value) {
            $id = DB::table('historical_portfolio_values')->insertGetId($value);            
        }          
    }
}
