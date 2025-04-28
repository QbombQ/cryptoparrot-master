<?php

use Illuminate\Database\Seeder;

class UserNotificationSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $settings = [
            
            [
                'trade_orders' => 1,
                'comments' => 1,
                'newsletters' => 1,
                'signals' => 1,
                'new_follows' => 1,
                'user_id' => 1
            ],
            [
                'trade_orders' => 1,
                'comments' => 1,
                'newsletters' => 1,
                'signals' => 1,
                'new_follows' => 1,
                'user_id' => 2
            ], 
            [
                'trade_orders' => 1,
                'comments' => 1,
                'newsletters' => 1,
                'signals' => 1,
                'new_follows' => 1,
                'user_id' => 3
            ],
            [
                'trade_orders' => 1,
                'comments' => 1,
                'newsletters' => 1,
                'signals' => 1,
                'new_follows' => 1,
                'user_id' => 4
            ],  
            [
                'trade_orders' => 1,
                'comments' => 1,
                'newsletters' => 1,
                'signals' => 1,
                'new_follows' => 1,
                'user_id' => 5
            ],
            [
                'trade_orders' => 1,
                'comments' => 1,
                'newsletters' => 1,
                'signals' => 1,
                'new_follows' => 1,
                'user_id' => 6
            ], 
            [
                'trade_orders' => 1,
                'comments' => 1,
                'newsletters' => 1,
                'signals' => 1,
                'new_follows' => 1,
                'user_id' => 7
            ],
            [
                'trade_orders' => 1,
                'comments' => 1,
                'newsletters' => 1,
                'signals' => 1,
                'new_follows' => 1,
                'user_id' => 8
            ],
            [
                'trade_orders' => 1,
                'comments' => 1,
                'newsletters' => 1,
                'signals' => 1,
                'new_follows' => 1,
                'user_id' => 9
            ],                                                                       
        ];
        foreach($settings as $setting) {
            DB::table('user_notification_settings')->insert($setting);
        }  
    }
}
