<?php

return [



    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

    ],



    'multi' => [ 
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\SystemUserModel::class,
            'table' => 'System_User'
        ]
    ]







];



