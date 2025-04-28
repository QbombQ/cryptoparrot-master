<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface QueueServiceInterface
{

    public function getJobsCurrentlyInQueue();

}