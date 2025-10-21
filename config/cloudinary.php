<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | هون منقرأ القيم من .env. 
    | خلي عندك خيارين: يا إما CLOUDINARY_URL كامل، 
    | أو القيم المنفصلة (CLOUD_NAME, API_KEY, API_SECRET).
    |
    */

    'cloud_url' => env('CLOUDINARY_URL'),

    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key'    => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
    ],

    'url' => [
        'secure' => true,
    ],

];
