<?php

use Illuminate\Database\Seeder;

class TradePairTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pairs = [
            [
                'from_currency_id' => 2,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1,
            ],  
            [
                'from_currency_id' => 3,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1,
            ],         
            [
                'from_currency_id' => 4,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1,
            ],  
            [
                'from_currency_id' => 3,
                'to_currency_id' => 2,
                'rate' => 1  
            ],  
            [
                'from_currency_id' => 5,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1, 
            ],  
            [
                'from_currency_id' => 6,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ],  
            [
                'from_currency_id' => 7,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ],  
            [
                'from_currency_id' => 8,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ],  
            [
                'from_currency_id' => 9,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ],  
            [
                'from_currency_id' => 10,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ], 
            [
                'from_currency_id' => 11,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ], 
            [
                'from_currency_id' => 12,
                'to_currency_id' => 1,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ],
            [
                'from_currency_id' => 13,
                'to_currency_id' => 2,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ], 
            [
                'from_currency_id' => 14,
                'to_currency_id' => 2,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ],
            [
                'from_currency_id' => 15,
                'to_currency_id' => 2,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ], 
            [
                'from_currency_id' => 16,
                'to_currency_id' => 2,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ],        
            [
                'from_currency_id' => 17,
                'to_currency_id' => 2,
                'rate' => 1,
                'show_on_currencies_page' => 1,  
            ],                                                                                       
        ];
        foreach($pairs as $pair) {
            DB::table('trade_pairs')->insert($pair);
        }         
    }
}
