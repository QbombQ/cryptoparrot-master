<?php

namespace App\Model\Facades;

class Feed {

    public static function getTimestamp($page)
    {

		if($page != 1) 
		{

			$page = request()->segment(4);

		}
		
		if($page == 1)
		{

			$timestamp = time();
			session(['feed_timestamp' => $timestamp]);

		}else{

			$timestamp = session('feed_timestamp');
			
        }
        
        return $timestamp;

    }

}