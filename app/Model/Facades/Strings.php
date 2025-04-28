<?php

namespace App\Model\Facades;
use Number;

class Strings {

    public static function sanitizeForUrl($string)
    {
        
        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $string);
        $url = trim($url, "-");
        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
        $url = strtolower($url);
        $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

        return $url;

    }

    public static function prepareTradeDescriptionForDisplay($trade)
    {

        if($trade->source && $trade->source_type !== 'image')
        {

            $tradeSource = json_decode($trade->source, true);
            switch($trade->source_type)
            {
                
                case 'video':
                    $trade->description = str_replace($tradeSource['video_link'], '<span style="display: none;">' . $tradeSource['video_link'] . '</span>', $trade->description);
                    break;
                case 'link':
                    $trade->description = str_replace($tradeSource['link'], '<span style="display: none;">' . $tradeSource['link'] . '</span>', $trade->description);
                    break;
                case 'trading_view':
                    $trade->description = array_key_exists('trading_view_link', $tradeSource) ? str_replace($tradeSource['trading_view_link'], '<span style="display: none;">' . $tradeSource['trading_view_link'] . '</span>', $trade->description) : $trade->description;
                    break;
    
            }

        }

        $links = self::extractLinks($trade->description);

        if(count($links) > 0)
        {

            foreach($links as $link)
            {

                if(strpos('niffler.co', $link) == -1)
                {
                    $trade->description = str_replace($link, '<a href="'.$link.'" rel="nofollow noopener" target="_blank">'.$link.'</a>', $trade->description);
                }

            }

        }

        return $trade->description;

    }

    public static function stringIsImageUrl($string)
    {

        if (preg_match('/(\.jpg|\.png|\.bmp)$/', $string))
        {

            return true;

        }
 
        return false;

    }

    public static function extractLinks($string)
    {

        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $string, $match);

        return $match[0];

    }

    public static function extractDomain($url)
    {

        $parse = parse_url($url);

        if($parse && array_key_exists('host', $parse))
        {
        
            return $parse['host'];
        }

        return false;

    }

    public static function stringContains($string, $substring)
    {

        if (strpos($string, $substring) !== false)
        {
            
            return true;

        }

        return false;

    }

    public static function extractLinkFromDescription($request)
    {

        $linksInDescription = Strings::extractLinks($request->description);

        if(count($linksInDescription) > 0)
        {

            $domain = Strings::extractDomain($linksInDescription[0]);

            if(Strings::stringContains($domain, 'youtube.com') && Strings::stringContains($linksInDescription[0], 'watch'))
            { 

                $request->merge([
                    'source_type' => 'video',
                    'video' => $linksInDescription[0]
                ]);

            }else if(Strings::stringContains($linksInDescription[0], 'tradingview.com/chart'))
            {

                $request->merge([
                    'source_type' => 'trading_view',
                    'trading_view' => $linksInDescription[0]
                ]);

            }else{

                $request->merge([
                    'source_type' => 'link',
                    'link' => $linksInDescription[0]
                ]);

            }

            return $request;

        }

        return $request;

    }

}