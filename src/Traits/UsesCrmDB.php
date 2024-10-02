<?php

namespace Bildvitta\IssCrm\Traits;

trait UsesCrmDB
{
    public function __construct(array $attributes = [])
    {
        $this->configDbConnection();
        parent::__construct($attributes);
    }

    public static function __callStatic($method, $parameters)
    {
        self::configDbConnection();

        return parent::__callStatic($method, $parameters);
    }

    protected static function configDbConnection()
    {
        config([
            'database.connections.iss-crm' => [
                'driver' => 'mysql',
                'host' => config('iss-crm.db.host'),
                'port' => config('iss-crm.db.port'),
                'database' => config('iss-crm.db.database'),
                'username' => config('iss-crm.db.username'),
                'password' => config('iss-crm.db.password'),
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
                'options' => [],
            ],
        ]);
    }
}
