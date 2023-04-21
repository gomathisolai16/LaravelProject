<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |
     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
     | to accept any value.
     |
     */
    'supportsCredentials' => false,
    'allowedOrigins' => array_filter([
        // Define 'Origin' for development within environment variables
        // so on local setup it will pass CORS validations
        env('LOCAL_CORS_ORIGIN', null)
    ]),
    'allowedHeaders' => [
        'Origin',
        'Authorization',
        'Content-Type',
        'Accept',
        'X-Requested-With',
        'Client-Security-Token',
        'X-Xsrf-Token'
    ],
    'allowedMethods' => [
        'GET',
        'OPTIONS',
        'POST',
        'PUT',
        'DELETE'
    ],
    'exposedHeaders' => [],
    'maxAge' => 0,
];
