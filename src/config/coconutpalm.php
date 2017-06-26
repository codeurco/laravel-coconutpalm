<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Your Coconut API Key ...
    |--------------------------------------------------------------------------
    |
    */    
    'api_key' => env('COCONUT_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | This package uses ngrok http tunnel to expose your Laravel 
    | application to the outside world during development. This is needed for 
    | Coconut to be able to reach your public API endpoints.
    |--------------------------------------------------------------------------
    |
    */    
    'http_tunnel_url' => env('NGROK_TUNNEL_URL', 'https://yourtemporarysubdomain.ngrok.io'),

    /*
    |--------------------------------------------------------------------------
    | All the media files will be uploaded to the CDN of your choice.
    | You can refer to coconut API document for more details:
    | http://coconut.co/docs/
    | 
    | Currently, only s3 is available for this package. Feel free to implement
    | other CDNs should you need it. Pull requests are always welcome! :)
    |--------------------------------------------------------------------------
    |
    */
    'cdn' => [
    	'use' => env('COCONUT_CDN', 's3'),

    	's3' =>  [
    		'key' => env('AWS_KEY'),
    		'secret' => env('AWS_SECRET'),
    		'bucket' => env('AWS_BUCKET'),
    	],
    ],

    /*
    |--------------------------------------------------------------------------
    | This is the directory where your original video files will be stored 
    | before being processed by this package.
    |--------------------------------------------------------------------------
    |
    */
    'videos_source_path' => '/storage/app/temp/videos/',

    /*
    |--------------------------------------------------------------------------
    | The following path must be public in order for Coconut to be able to fetch
    | the source video and its config file
    |--------------------------------------------------------------------------
    |
    */
    'videos_destination_path' => '/storage/app/public/videos/temp/',
];
