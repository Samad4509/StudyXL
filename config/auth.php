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

        'admin' => [ // for admin web session login (optional)
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'admin_token' => [ // API token guard for admin
            'driver' => 'sanctum',
            'provider' => 'admins',
        ],

        'agent' => [
            'driver' => 'session',
            'provider' => 'agents',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'agents' => [
            'driver' => 'eloquent',
            'model' => App\Models\Agent::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
