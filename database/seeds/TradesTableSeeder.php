<?php

use Illuminate\Database\Seeder;

class TradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trades = [
            
            [
                'type' => 'long',
                'amount' => 2,
                'source_type' => 'video',
                'description'=>'This video gives me confidence in Bitcoin.',
                'source' => json_encode(array(
                    'video_link'=>'https://www.youtube.com/watch?v=b78YnwQ9gjY'
                 )), 
                'target_price' => 12000,
                'user_id' => 1,
                
                
                'status' => 'open',
                'leverage' => 4,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()   ,
                'archived' => 1               
            ],
            [
                'type' => 'buy',
                'amount' => 2,
                'source_type' => 'link',
                'description'=>'ETF will come in sooner on later, which will give BTC price a boost',
                'source' => json_encode(array(
                    'link'=>'https://cointelegraph.com/news/reality-shares-will-join-increasingly-crowded-bitcoin-hedge-fund-arena-says-source',
                    'og_image'=>'https://images.cointelegraph.com/images/740_aHR0cHM6Ly9zMy5jb2ludGVsZWdyYXBoLmNvbS9zdG9yYWdlL3VwbG9hZHMvdmlldy8yYjNhMDdlM2ZlNzRhODNiNmIzN2VlMjgyZDllMzE3MC5qcGc=.jpg',
                    'meta_title'=>'Reality Shares Will Join Increasingly Crowded Bitcoin Hedge Fund Arena, Says Source',
                    'meta_description'=>'An anonymous source says blockchain ETF operator Reality Shares wants to launch a Bitcoin hedge fund.'
                 )),   
                'target_price' => 500,
                'user_id' => 3,
                
                
                'status' => 'finished',
                'created_at' => \Carbon\Carbon::now()->subHours(1),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1
            ],
            [
                'type' => 'sell',
                'amount' => 0.234000,
                'description'=>'Selling with intention to get back in at lower price point.',
                'source_type' => null,
                'source' => null,
                'target_price' => 500,
                'user_id' => 3,
                
                
                'status' => 'finished',
                'created_at' => \Carbon\Carbon::now()->subDays(4),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1
            ],
            [
                'type' => 'sell',
                'amount' => 1.14000,
                'source_type' => null,
                'source' => null,
                'target_price' => 500,
                'user_id' => 3,
                
                
                'status' => 'finished',
                'created_at' => \Carbon\Carbon::now()->subDays(4),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1
            ], 
            [
                'type' => 'buy',
                'amount' => 0.14000,
                'description'=>'I\'m following CryptoManiac101 TA. Let\'s see where it leads me...',
                'source_type' => 'trading_view', 
                'source' => json_encode(array(
                    'trading_view_code'=>'nH86C8x3'
                 )),  
                'target_price' => 999,
                'user_id' => 3,
                
                
                'status' => 'finished',
                'created_at' => \Carbon\Carbon::now()->subDays(4),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1
            ], 
            [
                'type' => 'sell',
                'amount' => 0.124000,
                'source_type' => null,
                'source' => null,
                'target_price' => 6500,
                'user_id' => 4,
                
                
                'status' => 'finished',
                'created_at' => \Carbon\Carbon::now()->subDays(4),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1
            ],
            /*
            [
                'type' => 'buy',
                'amount' => 2.1,
                'source_type' => null,
                'source' => null,
                'target_price' => 500,
                'user_id' => 2,
                
                
                'status' => 'finished',
                'paid_only' => 0,
                'created_at' => \Carbon\Carbon::now()->subDays(2),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1               
            ],*/
            [
                'type' => 'buy',
                'amount' => 2,
                'description'=>'I\'m following CryptoManiac101 TA. Let\'s see where it leads me.',
                'source_type' => 'trading_view',
                'source' => json_encode(array(
                    'trading_view_code'=>'nH86C8x3'
                 )), 
                'target_price' => 500,
                'user_id' => 4,
                
                
                'status' => 'finished',
                'paid_only' => 1,
                'created_at' => \Carbon\Carbon::now()->subDays(12),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1               
            ],
            [
                'type' => 'buy',
                'amount' => 2,
                'source_type' => null,
                'source' => null,
                'target_price' => 500,
                'user_id' => 1,
                
                
                'status' => 'finished',
                'paid_only' => 0,
                'created_at' => \Carbon\Carbon::now()->subDays(45),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1                  
            ],
            [
                'type' => 'buy',
                'amount' => 1.2,
                'description'=>'Good time to get in, I was wating for such market crash for a while.',
                'source_type' => null,
                'source' => null, 
                'target_price' => 500,
                'user_id' => 5,
                
                
                'status' => 'finished',
                'paid_only' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1                 
            ],
            [
                'type' => 'buy',
                'amount' => 2,
                'description'=>'ICOs has created massive sell pressure on altcoins and Bitcoin. Bitcoin showed strong resistance at @ $6000, therefore it should go up in next few days.',
                'source_type' => null,
                'source' => null,
                'target_price' => 500,
                'user_id' => 6,
                
                
                'status' => 'finished',
                'paid_only' => 0,
                'created_at' => \Carbon\Carbon::now()->subDays(9),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1                  
            ],
            [
                'type' => 'buy',
                'amount' => 2,
                'description'=>'I\'m following TomProTrader\'s TA. Let\'s see where it will lead me.',
                'source_type' => 'trading_view',
                'source' => json_encode(array(
                    'trading_view_code'=>'zZO0J7NA'
                 )),  
                'target_price' => 500,
                'user_id' => 7,
                
                
                'status' => 'finished',
                'paid_only' => 0,
                'created_at' => \Carbon\Carbon::now()->subDays(14),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1
            ],
            [
                'type' => 'buy',
                'amount' => 2,
                'source_type' => null,
                'source' => null,
                'target_price' => 500,
                'user_id' => 1,
                
                
                'status' => 'finished',
                'paid_only' => 1,
                'created_at' => \Carbon\Carbon::now()->subDays(12),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1                  
            ], 
            [
                'type' => 'long',
                'amount' => 15,
                'target_price' => 5000,
                'start_price' => 5000,
                'leverage' => 3,
                'user_id' => 1,
                
                
                'status' => 'open',
                'created_at' => \Carbon\Carbon::now()->subDays(2),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1                    
            ],
            /*
            [
                'type' => 'long',
                'amount' => 15,
                'target_price' => 5000,
                'start_price' => 5000,
                'leverage' => 3,
                'user_id' => 2,
                
                
                'status' => 'open',
                'created_at' => \Carbon\Carbon::now()->subDays(2),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1                    
            ],
            [
                'type' => 'long',
                'amount' => 15,
                'target_price' => 5000,
                'start_price' => 5000,
                'leverage' => 3,
                'user_id' => 2,
                
                
                'status' => 'open',
                'created_at' => \Carbon\Carbon::now()->subDays(10),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1                     
            ],
            [
                'type' => 'long',
                'amount' => 15,
                'target_price' => 5000,
                'start_price' => 5000,
                'leverage' => 3,
                'user_id' => 2,
                
                
                'status' => 'open',
                'created_at' => \Carbon\Carbon::now()->subDays(10),
                'updated_at' => \Carbon\Carbon::now(),
                'archived' => 1                     
            ] */                               
        ];
        foreach($trades as $trade) {
            DB::table('trades')->insert($trade);
        } 
    }
}
