<?php

use Illuminate\Database\Seeder;

class ConversationMessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $conversationMessages = [
            [
                'conversation_id' => 1,
                'message' => 'Message from initiator',
                'author' => 'initiator',
                'created_at' => \Carbon\Carbon::now()->subDays(1),
                'updated_at' => \Carbon\Carbon::now()->subDays(1)
            ],
            [
                'conversation_id' => 1,
                'message' => 'Message from recipient',
                'author' => 'recipient',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'conversation_id' => 2,
                'message' => 'Message from recipient',
                'author' => 'recipient',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]            
        ];
        foreach($conversationMessages as $message) {
            DB::table('conversation_messages')->insert($message);
        }

    }
}
