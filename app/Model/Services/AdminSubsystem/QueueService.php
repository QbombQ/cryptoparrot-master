<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\QueueServiceInterface;
use Illuminate\Support\Facades\Redis;

class QueueService implements QueueServiceInterface
{

    public function getJobsCurrentlyInQueue()
    {

        $live_high = Redis::lrange('queues:'.env('PREFIX').'-high', 0, -1);
        $live_low = Redis::lrange('queues:'.env('PREFIX').'-low', 0, -1);
        $default = Redis::lrange('queues:default', 0, -1);

        $jobs = array_merge($live_high, $live_low, $default);
       
        $preparedJobs = [];

        if(count($jobs) > 0)
        {
 
            $jobs = array_reverse($jobs);
            
            foreach($jobs as $job)
            {

				$jobObject = json_decode($job, true);

				$preparedJobs[] = [
					'type' => $jobObject['displayName']
                ];
                
            }
            
        }
        
        return $preparedJobs;

    }

}