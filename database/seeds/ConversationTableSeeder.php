<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ConversationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conversations = [
            [
                'initiator_id' => 1,
                'recipient_id' => 2,
                'initiator_status' => 'unread',
                'recipient_status' => 'read',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'initiator_id' => 1,
                'recipient_id' => 3,
                'initiator_status' => 'read',
                'recipient_status' => 'unread',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]                                            
        ];
        foreach($conversations as $conversation) {
            DB::table('conversations')->insert($conversation);
        }           
    }
}
