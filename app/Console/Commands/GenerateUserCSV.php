<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App;
use Mail;
use Response;
use Storage;

class GenerateUserCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:csv {--type=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating user CSV report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $type = $this->option('type');
        $this->info('Type:'.$type); 

        if($type == 'all'){

            $users = \App\Model\Data\Models\User::with('notificationSettings')->get()->toArray();

        }elseif($type == 'confirmed'){

            $users = \App\Model\Data\Models\User::where('status', 'confirmed')
            ->whereHas("notificationSettings", function($q){
               $q->where("newsletters","=","true");
            })->with('notificationSettings')->get()->toArray();

        }elseif($type == 'unconfirmed'){

            $users = \App\Model\Data\Models\User::where('status', 'unconfirmed')
            ->whereHas("notificationSettings", function($q){
               $q->where("newsletters","=","true");
            })->with('notificationSettings')->get()->toArray();

        }elseif($type == 'notrades'){

            $users = \App\Model\Data\Models\User::whereHas("notificationSettings", function($q){
               $q->where("newsletters","=","true");
            })->whereDoesntHave('trades')->with('notificationSettings')->get()->toArray();

        } 
 
        $file = 'export-'.$type.'-'.date('Y-m-d').'.csv';

        Storage::disk('local')->append($file, 'Username,Email,Status,Newsletter');

        foreach($users as $user) {
            
            Storage::disk('local')->append($file, $user['username'].','.$user['email'].','.$user['status'].','.$user['notification_settings']['newsletters'] );

        } 

        $contents = Storage::disk('local')->get($file);
  
        Mail::raw('export - '.$file, function ($message) use ($contents,$file){

            $message->from('no-reply@niffler.oc', 'Niffler');
            $message->to('voouss@gmail.com', 'Aidas')->subject('Generated export');
            $message->attach(storage_path('app/'.$file));
 
        });   

        Storage::delete($file);   
    
    }   
}