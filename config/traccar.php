<?php

return [
    'base_url' => env('TRACCAR_BASE_URL'),

    'debug_requests' => true,

    'auth' => [
        'username' => env('TRACCAR_USERNAME'),
        'password' => env('TRACCAR_PASSWORD'),
    ]
];
