<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Authen1ca1on Defaults
    |--------------------------------------------------------------------------
    |
    | This op1on defines the default authen1ca1on "guard" and password
    | reset "broker" for your applica1on. You may change these values
    | as required, but they're a perfect start for most applica1ons.
    |
    */
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],
    /*
    |--------------------------------------------------------------------------
    | Authen1ca1on Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authen1ca1on guard for your applica1on.
    | Of course, a great default configura1on has been defined for you
    | which u1lizes session storage plus the Eloquent user provider.
    |
    | All authen1ca1on guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the applica1on. Typically, Eloquent is u1lized.
    |
    | Supported: "session"
    |
    */
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authen1ca1on guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the applica1on. Typically, Eloquent is u1lized.
    |
    | If you have mul1ple user tables or models you may configure mul1ple
    | providers to represent the model / table. These providers may then
    | be assigned to any extra authen1ca1on guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        // 'users' => [
        // 'driver' => 'database',
        // 'table' => 'users',
        // ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Resecng Passwords
    |--------------------------------------------------------------------------
    |
    | These configura1on op1ons specify the behavior of Laravel's password
    | reset func1onality, including the table u1lized for token storage
    | and the user provider that is invoked to actually retrieve users.
    |
    | The expiry 1me is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less 1me to be guessed. You may change this as needed.
    |
    | The throdle secng is the number of seconds a user must wait before
    | genera1ng more password reset tokens. This prevents the user from
    | quickly genera1ng a very large amount of password reset tokens.
    |
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throdle' => 60,
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Password Confirma1on Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirma1on
    | window expires and users are asked to re-enter their password via the
    | confirma1on screen. By default, the 1meout lasts for three hours.
    |
    */
    'password_1meout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];