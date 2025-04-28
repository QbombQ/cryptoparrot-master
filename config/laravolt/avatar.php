<?php
/*
 * Set specific configuration variables here
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    | Avatar use Intervention Image library to process image.
    | Meanwhile, Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */
    'driver'    => 'gd',

    // Initial generator class
    'generator' => \Laravolt\Avatar\Generator\DefaultGenerator::class,

    // Whether all characters supplied must be replaced with their closest ASCII counterparts
    'ascii'    => false,

    // Image shape: circle or square
    'shape' => 'square',

    // Image width, in pixel
    'width'    => 256,

    // Image height, in pixel
    'height'   => 256,

    // Number of characters used as initials. If name consists of single word, the first N character will be used
    'chars'    => 1,

    // font size
    'fontSize' => 130,

    // convert initial letter in uppercase
    'uppercase' => false,

    // Fonts used to render text.
    // If contains more than one fonts, randomly selected based on name supplied
    'fonts'    => [__DIR__.'/../fonts/OpenSans-Bold.ttf', __DIR__.'/../fonts/rockwell.ttf'],

    // List of foreground colors to be used, randomly selected based on name supplied
    'foregrounds'   => [
        '#fffff',
    ],

    // List of background colors to be used, randomly selected based on name supplied
    'backgrounds'   => [
        '#f14742',
        '#623869',
        '#2d8ee4',
        '#765bcd',
        '#584b98',
        '#2d8fe5',
        '#da3f3c',
        '#6a3873',
        '#535ba2',
        '#6053ab',
        '#8c40d6',
        '#9a32ad',
        '#3e6bd4',
        '#853fc6',
        '#733e97',
    ],

    'border'    => [
        'size'  => 0,

        // border color, available value are:
        // 'foreground' (same as foreground color)
        // 'background' (same as background color)
        // or any valid hex ('#aabbcc')
        'color' => 'foreground',
    ],
];
