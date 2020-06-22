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
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
           'model' => App\Models\SystemUserModel::class,
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
