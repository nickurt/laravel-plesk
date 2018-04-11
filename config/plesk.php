<?php

return [

    'default' => env('PLESK_SERVER', 'default'),

    'servers' => [

        'default' => [
            'host' => env('PLESK_DEFAULT_HOST'),
            'username' => env('PLESK_DEFAULT_USERNAME'),
            'password' => env('PLESK_DEFAULT_PASSWORD'),
        ],

    ],

];