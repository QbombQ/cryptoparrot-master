<?php

use Illuminate\Database\Seeder;

class UserNotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $notifications = [
            
            [
                'user_id' => 1,
                'type_id' => 1,
                'text' => 'Your trade has been closed',
                'url' => '/app/trade',
                'status' => 'unread',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 1,
                'type_id' => 1,
                'text' => 'Your trade has been closed',
                'url' => '/app/trade',
                'status' => 'read',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]                                  
        ];
        foreach($notifications as $notification) {
            DB::table('user_notifications')->insert($notification);
        }   */      
    }
}
