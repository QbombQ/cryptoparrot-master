<?php

use Illuminate\Database\Seeder;

class UserSocialMediaAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            [
                'user_id' => 1,
                'social_network' => 'facebook',
                'url' => 'https://www.facebook.com/eugenijus.ostapenko',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 1,
                'social_network' => 'twitter',
                'url' => 'https://twitter.com/jumpman23',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],            
            [
                'user_id' => 2,
                'social_network' => 'facebook',
                'url' => 'https://www.facebook.com/profile.php?id=100009193583843',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => 3,
                'social_network' => 'twitter',
                'url' => 'https://twitter.com/Nike',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],            
        ];
        foreach($accounts as $account) {
            DB::table('user_social_media_accounts')->insert($account);
        }  
    }
}
