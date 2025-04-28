<?php

use Illuminate\Database\Seeder;

class TradeCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = [
            [
                'comment' => 'Hey, great trade',
                'user_id' => 2,
                'trade_id' => 1,
                'reply_to' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()                                     
            ],
            [
                'comment' => 'I disagree, such trade can lead you to bankruptcy',
                'user_id' => 2,
                'trade_id' => 1,
                'reply_to' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()                                     
            ],
            [
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis elementum nunc, nec laoreet ex. Praesent condimentum enim a eleifend consectetur. Ut arcu nisi, fringilla a sem et, congue sollicitudin tortor.',
                'user_id' => 3,
                'trade_id' => 1,
                'reply_to' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()                                     
            ],
            [
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis elementum nunc, nec laoreet ex. Praesent condimentum enim a eleifend consectetur. Ut arcu nisi, fringilla a sem et, congue sollicitudin tortor.',
                'user_id' => 4,
                'trade_id' => 1,
                'reply_to' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()                                     
            ],
            [
                'comment' => 'hmm, interesting approach... I would hesitate to make such trade in current market.',
                'user_id' => 6,
                'trade_id' => 2,
                'reply_to' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()                                     
            ],
            [
                'comment' => 'LOL, made me laugh...',
                'user_id' => 6,
                'trade_id' => 3,
                'reply_to' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()                                     
            ],                                                 
        ];
        foreach($comments as $comment) {
            DB::table('trade_comments')->insert($comment);
        } 
    }
}
