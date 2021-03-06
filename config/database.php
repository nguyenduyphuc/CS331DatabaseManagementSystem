<?php
$sentinels = env('SENTINELS', '');
$sentinels = explode(',', $sentinels);
$sentinels = array_map(
    function ($string) {
        $parts = explode(':', $string);
        return [
            'host' => $parts[0],
            'port' => $parts[1],
        ];
    },
    $sentinels
);
return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'default' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'mysql'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('MYSQL_DATABASE', 'forge'),
            'username' => env('MYSQL_USER', 'root'),
            'password' => env('MYSQL_PASSWORD', 'root'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [
        'client' => 'predis',
        'nodeSetName'      => env('SENTINEL_NODE_SET_NAME', 'mymaster'),
        /** Array of sentinels */
        'clusters'          => false,
        'masters'           => $sentinels,
        /** how long to wait and try again if we fail to connect to master */
        'backoff-strategy' => [
            'max-attempts' => env('SENTINEL_MAX_ATTEMPTS', 10),
            // the maximum-number of attempt possible to find master
            'wait-time'    => env('SENTINEL_WAIT_TIME', 500),
            // miliseconds to wait for the next attempt
            'increment'    => env('SENTINEL_INCREMENT', 1.5),
            // multiplier used to increment the back off time on each try
        ]
    ],

];
