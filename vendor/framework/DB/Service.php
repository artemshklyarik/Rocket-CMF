<?php

namespace Framework\DB;

use Framework\DI;

final class Service extends \Framework\Service
{
    private $pdo;

    public function start(DI $di)
    {
        $databaseConfig = $di->get('config')->getDatabaseConfig();
        $driver         = $databaseConfig['driver'];
        $credentials    = $databaseConfig[$driver];
        $host           = $credentials['host'];
        $db             = $credentials['database'];
        $user           = $credentials['user'];
        $pass           = $credentials['password'];
        $charset        = 'utf8';

        $dsn = "$driver:host=$host;dbname=$db;charset=$charset";

        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new \PDO($dsn, $user, $pass, $opt);
        } catch (PDOException $e) {
            exit('Cannot access to database: ' . $e->getMessage());
        }

    }

    public function finish(DI $di)
    {
        return;
    }
}
