<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use App;

class UserIsUsingVPN implements Rule
{

    public function passes($attribute, $value)
    {

    	try {
			$block = $this->isBadIP(Auth::user()->ip, "MTMxNTQ6WG5NQ1h6YnZ0UHpNZktTZnl2SFVNbVAyY1dOcUpsaXY=", true);
		} catch (Exception $e) {
			$block = false;
		}

        if($block)
        {
            return false;
        }

        return true;

    }

    public function message()
    {

        return 'Please disable your VPN in order to claim rewards. If having issues, email us at rewards@cryptoparrot.com';
        
    } 

    public static function isBadIP(string $ip, string $key, bool $strict = false) {

		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => "http://v2.api.iphub.info/ip/{$ip}",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => ["X-Key: {$key}"]
		]);
		try {
			$block = json_decode(curl_exec($ch))->block;
		} catch (Exception $e) {
			throw $e;
		}
		if ($block) {
			if ($strict) {
				return true;
			} elseif (!$strict && $block === 1) {
				return true;
			}
		}
		return false;
	}

} 
