<?php

use Illuminate\Database\Seeder;

class NotificationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'icon' => 'fa-exchange',
                'title' => 'Trade completed'
            ],
            [
                'icon' => 'fa-comment-lines',
                'title' => 'Trade commented'
            ],
            [
                'icon' => 'fa-megaphone',
                'title' => 'Trade voted'
            ],            
            [
                'icon' => 'fa-star',
                'title' => 'New follow'
            ],
            [
                'icon' => 'fa-badge-check',
                'title' => 'Badge received'
            ],
            [
                'icon' => 'fa-trophy',
                'title' => 'Competition won'
            ],
            [
                'icon' => 'fa-exclamation-circle',
                'title' => 'Action Required'
            ],
            [
                'icon' => 'fa-exclamation-circle',
                'title' => 'Position liquidated'
            ],  
            [
                'icon' => 'fa-comments',
                'title' => 'New Reply'
            ],                
            [
                'icon' => 'fa-exclamation-circle',
                'title' => 'You were mentioned'
            ],
            [
                'icon' => 'fa-exclamation-circle',
                'title' => 'First trade'
            ],  
            [
                'icon' => 'fa-exclamation-circle',
                'title' => 'New patron'
            ],     
            [
                'icon' => 'fa-exclamation-circle',
                'title' => 'Subscription cancelled'
            ],
            [
                'icon' => 'fa-exclamation-circle',
                'title' => 'Need more details'
            ],
            [
                'icon' => 'fa-exclamation-circle',
                'title' => 'Payout paid'
            ],
            [
                'icon' => 'fa-exclamation-circle',
                'title' => 'Signal'
            ],
            [
                'icon' => 'fa-exclamation-circle',
                'title' => 'Trade not executed'
            ]
        ];
        foreach($types as $type) {
            DB::table('notification_types')->insert($type);
        }  
    } 
}
