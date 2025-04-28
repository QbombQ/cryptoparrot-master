<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $currencies = [
            [
                'acronym' => 'USD',
                'name' => 'US Dollar',
                'symbol' => '$',
                'usd_value' => 1,
                'crypto' => false,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'BTC',
                'name' => 'Bitcoin',
                'symbol' => '฿',
                'usd_value' => 5000,
                'crypto' => true,
                'average_usd_value' => 1,
                'primary_pair' => 1,
                'description' => 'Bitcoin description',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'ETH',
                'name' => 'Ethereum',
                'symbol' => 'Ξ',
                'usd_value' => 593,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'LTC',
                'name' => 'Litecoin',
                'symbol' => 'Ł',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [ 
                'acronym' => 'XRP',
                'name' => 'Ripple',
                'symbol' => 'XRP',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'EOS',
                'name' => 'EOS',
                'symbol' => 'EOS ',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'DSH',
                'name' => 'DASH',
                'symbol' => 'DSH ',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'XMR',
                'name' => 'Monero',
                'symbol' => 'XMR ',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'NEO',
                'name' => 'NEO',
                'symbol' => 'NEO ',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'OMG',
                'name' => 'OmiseGo',
                'symbol' => 'OMG ',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'TUBE',
                'name' => 'TUBE',
                'symbol' => 'TUBE ',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'DGB',
                'name' => 'DigiByte',
                'symbol' => 'DGB ',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'DOGE',
                'name' => 'DOGE',
                'symbol' => 'DOGE',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'STEEM',
                'name' => 'STEEM',
                'symbol' => 'STEEM',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'THR',
                'name' => 'ThoreCoin',
                'symbol' => 'THR',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'BAT',
                'name' => 'Basic Attention Token',
                'symbol' => 'BAT',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],
            [
                'acronym' => 'RVN',
                'name' => 'Ravencoin',
                'symbol' => 'RVN',
                'usd_value' => 123,
                'crypto' => true,
                'average_usd_value' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ]                                                                                             
        ];  
        foreach($currencies as $currency) {
            DB::table('currencies')->insert($currency);            
        }  
    }
}
