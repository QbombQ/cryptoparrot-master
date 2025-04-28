<?php

namespace App\Model\Facades;

use LaravelVideoEmbed;
use Illuminate\Support\Facades\Storage;
use Avatar;

class Media {

    public static function getTradingViewCode($tradingViewUrl)
    {

        $re = '/.+tradingview.com\/chart\/.+\/([a-zA-Z0-9]+)-.+/m';
        $str =  $tradingViewUrl;
        preg_match($re, $str, $matches);

        if(isset($matches[1]))
        {
         
            return $matches[1];

        }

        return null;

    }

    public static function getTradingViewHtmlCode($tradingViewCode)
    {

        return '<div id="trading_view_'.$tradingViewCode.'" data-trading-view="'.$tradingViewCode.'" class=""></div>';

    }

    public static function getVideoEmbedCode($videoUrl)
    {

        return '<div class="videoWrapper">' . str_replace('width="480"', 'width="694"', LaravelVideoEmbed::parse($videoUrl)->getEmbedCode()) . '</div>';

    }

    public static function getUserAvatarArray($user, $encode = false, $dimensions = 256, $fontSize = 130)
    {

        if($user['avatar'])
        {

            return Storage::disk('public')->url($user['avatar']);

        }

        $avatar = Avatar::create($user['username'])->setDimension($dimensions, $dimensions)->setFontSize($fontSize)->toBase64();

        return $encode ? $avatar->encoded : $avatar;

    }

    public static function getUserAvatar($user, $encode = false, $dimensions = 256, $fontSize = 130)
    {

        if(is_array($user))
        {

            return Media::getUserAvatarArray($user, $encode, $dimensions, $fontSize);

        }

        if($user->avatar)
        {

            return Storage::disk('public')->url($user->avatar);

        }

        $avatar = Avatar::create($user->username)->setDimension($dimensions, $dimensions)->setFontSize($fontSize)->toBase64();

        return $encode ? $avatar->encoded : $avatar;

    }

    public static function getUserCover($user, $encode = false, $dimensionX = 200, $dimensionY = 80, $fontSize = 0)
    {

        if($user->cover)
        {

            return Storage::disk('public')->url($user->cover);

        }

        $cover = Avatar::create($user->username)->setDimension($dimensionX, $dimensionY)->setFontSize($fontSize)->toBase64();

        return $encode ? $cover->encoded : $cover;

    }

}