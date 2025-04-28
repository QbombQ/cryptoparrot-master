<?php

use Illuminate\Database\Seeder;

class PortfolioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portfolios = [
            [
                'user_id' => 1,
                'start_portfolio_value_in_usd' => 100000,
                'portfolio_value_in_usd' => 100000,
                'title' => 'Main',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 2,
                'start_portfolio_value_in_usd' => 100000,
                'portfolio_value_in_usd' => 100000,
                'title' => 'Main',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 3,
                'start_portfolio_value_in_usd' => 100000,
                'portfolio_value_in_usd' => 100000,
                'title' => 'Main',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 4,
                'start_portfolio_value_in_usd' => 100000,
                'portfolio_value_in_usd' => 100000,
                'title' => 'Main',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 5,
                'start_portfolio_value_in_usd' => 100000,
                'portfolio_value_in_usd' => 100000,
                'title' => 'Main',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],                                
            [
                'user_id' => 6,
                'start_portfolio_value_in_usd' => 100000,
                'portfolio_value_in_usd' => 100000,
                'title' => 'Main',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 7,
                'start_portfolio_value_in_usd' => 100000,
                'portfolio_value_in_usd' => 100000,
                'title' => 'Main',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 8,
                'start_portfolio_value_in_usd' => 100000,
                'portfolio_value_in_usd' => 100000,
                'title' => 'Main',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 9,
                'start_portfolio_value_in_usd' => 100000,
                'portfolio_value_in_usd' => 100000,
                'title' => 'Main',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 10,
                'start_portfolio_value_in_usd' => 100000,
                'portfolio_value_in_usd' => 100000,
                'title' => 'Main',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ];
        foreach($portfolios as $portfolio) {
            $id = DB::table('portfolios')->insertGetId($portfolio);            
        }
    }
}
