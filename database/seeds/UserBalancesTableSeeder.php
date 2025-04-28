<?php

use Illuminate\Database\Seeder;

class UserBalancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userBalances = [
            [
                'user_id' => 1,
                'currency_id' => 1,
                'amount' => 0.000000000000002,
                'usd_value' => 50000,
                'reserved_amount' => 24000,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 1,
                'currency_id' => 2,
                'amount' => 10.12345675,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 1,
                'currency_id' => 3,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 1,
                'currency_id' => 4,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],                                   
            [
                'user_id' => 2,
                'currency_id' => 1,
                'amount' => 200000,
                'usd_value' => 200000,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 2,
                'currency_id' => 2,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 2,
                'currency_id' => 3,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 2,
                'currency_id' => 4,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],   
            [
                'user_id' => 3,
                'currency_id' => 1,
                'amount' => 50000,
                'usd_value' => 50000,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 3,
                'currency_id' => 2,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 3,
                'currency_id' => 3,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 3,
                'currency_id' => 4,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],   
            [
                'user_id' => 4,
                'currency_id' => 1,
                'amount' => 50000,
                'usd_value' => 50000,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 4,
                'currency_id' => 2,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 4,
                'currency_id' => 3,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 4,
                'currency_id' => 4,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],   
            [
                'user_id' => 5,
                'currency_id' => 1,
                'amount' => 50000,
                'usd_value' => 50000,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 5,
                'currency_id' => 2,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 5,
                'currency_id' => 3,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 5,
                'currency_id' => 4,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],   
            [
                'user_id' => 6,
                'currency_id' => 1,
                'amount' => 50000,
                'usd_value' => 50000,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 6,
                'currency_id' => 2,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 6,
                'currency_id' => 3,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 6,
                'currency_id' => 4,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],  
            [
                'user_id' => 7,
                'currency_id' => 1,
                'amount' => 50000,
                'usd_value' => 50000,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 7,
                'currency_id' => 2,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 7,
                'currency_id' => 3,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],  
            [
                'user_id' => 7,
                'currency_id' => 4,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 8,
                'currency_id' => 1,
                'amount' => 50000,
                'usd_value' => 50000,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 8,
                'currency_id' => 2,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 8,
                'currency_id' => 3,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],  
            [
                'user_id' => 8,
                'currency_id' => 4,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 9,
                'currency_id' => 1,
                'amount' => 50000,
                'usd_value' => 50000,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 9,
                'currency_id' => 2,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 9,
                'currency_id' => 3,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],  
            [
                'user_id' => 9,
                'currency_id' => 4,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 10,
                'currency_id' => 1,
                'amount' => 50000,
                'usd_value' => 50000,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 10,
                'currency_id' => 2,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], 
            [
                'user_id' => 10,
                'currency_id' => 3,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],  
            [
                'user_id' => 10,
                'currency_id' => 4,
                'amount' => 0,
                'usd_value' => 0,
                'reserved_amount' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],                                
        ];
        foreach($userBalances as $userBalance) {
            DB::table('user_balances')->insert($userBalance);
        } 
    }
}
