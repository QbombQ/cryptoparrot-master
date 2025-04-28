<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       

        $users = [
            [
                'email' => 'aidas@digiiital.com',
                'password' => Hash::make('password'),
                'avatar' => 'images/seeder/avatar-1.jpg',
                'cover' => null,  
				'username' => 'CryptoPizza',
                'status' => 'confirmed',
                'method' => 'email',
                'key' => null,
                'ref_code' => 'steem',
                'type' => 'trader',
                'description' => 'I confirmed my account. Registered with email',
                'handle' => 'cryptopizza',
                'location' => 'Chicago',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [ 
                'email' => 'tokavaliauskas@gmail.com',
                'password' => Hash::make('password'),
                'avatar' => 'images/seeder/avatar-2.jpg',
                'cover' => null,
                'username' => 'TheCryptoCat',
                'status' => 'confirmed',
                'method' => 'email',
                'key' => null,
                'ref_code' => 'uzdarbis',
                'type' => 'admin',
                'description' => 'I has not confirmed my account. Registered with email',
                'handle' => 'cryptocat',
                'location' => 'Moscow',  
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [ 
                'email' => 'cinikas11@gmail.com',
                'password' => Hash::make('password'),
                'avatar' => 'images/seeder/avatar-3.jpg',
                'cover' => null,
				'username' => 'Cinikas',
                'status' => 'unconfirmed',
                'method' => 'email',
                'key' => null,
                'ref_code' => 'uzdarbis',
                'type' => 'admin',
                'description' => 'I has not confirmed my account. Registered with email',
                'handle' => 'cinikas',
                'location' => 'Moscow',  
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'ghosted' => 1
            ], 
            [ 
                'email' => 'cinikas13@gmail.com',
                'password' => Hash::make('password'),
                'avatar' => 'images/seeder/avatar-4.jpg',
                'cover' => null,
				'username' => 'Etheeer',
                'status' => 'confirmed',
                'method' => 'email',
                'key' => null,
                'ref_code' => null,
                'type' => 'admin',
                'description' => 'I has not confirmed my account. Registered with email',
                'handle' => 'etheeer',
                'location' => 'Moscow',  
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [ 
                'email' => 'cinikas15@gmail.com',
                'password' => Hash::make('password'),
                'avatar' => 'images/seeder/avatar-5.jpg',
                'cover' => null,
				'username' => 'Whale',
                'status' => 'confirmed',
                'method' => 'email',
                'key' => null,
                'ref_code' => null,
                'type' => 'admin',
                'description' => 'I has not confirmed my account. Registered with email',
                'handle' => 'whale',
                'location' => 'Moscow',  
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],                                     
            [
                'email' => 'confirmedtrader@facebook.com',
                'password' => Hash::make('password'),
                'avatar' => 'images/seeder/avatar-6.jpg',
                'cover' => null,
                'key' => '123456',
				'username' => 'CryptoSocial',
                'status' => 'confirmed',
                'method' => 'facebook',
                'type' => 'trader',
                'description' => 'I confirmed my account. Registered with facebook',
                'handle' => 'cryptosocial',
                'ref_code' => null,
                'location' => null,        
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'email' => 'george@niffler.co',
                'password' => null,
                'avatar' => 'images/seeder/avatar-7.jpg',
                'cover' => null,
                'username' => 'Georgie',
                'key' => null,
                'status' => 'confirmed',
                'method' => 'email',
                'type' => 'trader',
                'description' => 'I\'m Georgie',
                'handle' => 'dolphin',
                'location' => null,     
                'ref_code' => null,          
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'email' => 'aidas@worldwidedigitalmedia.co.uk',
                'password' => null,
                'avatar' => null,
                'cover' => null,
                'username' => 'wddddmm',
                'key' => null,
                'status' => 'confirmed',
                'method' => 'email',
                'type' => 'trader',
                'description' => 'Let\'s trade some more!',
                'handle' => 'wddddmm',
                'location' => null,     
                'ref_code' => null,          
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'email' => 'contact@niffler.co',
                'password' => null,
                'avatar' => null,
                'cover' => null,
                'username' => 'JustJohn',
                'key' => null,
                'status' => 'confirmed',
                'method' => 'email',
                'type' => 'trader',
                'description' => 'Let\'s trade some more!',
                'handle' => 'justjohn',
                'location' => null,     
                'ref_code' => null,       
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],  
            [
                'email' => 'careers@niffler.co',
                'password' => null,
                'avatar' => null,
                'cover' => null,
                'username' => 'Reese',
                'key' => null,
                'status' => 'confirmed',
                'method' => 'email',
                'type' => 'trader',
                'description' => 'Let\'s trade some more!',
                'handle' => 'reese',
                'location' => null,     
                'ref_code' => null,       
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ];
        foreach($users as $user) {
            $id = DB::table('users')->insertGetId($user);            
        }  

    }

}
