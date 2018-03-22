<?php

namespace Framework\DB;

use Framework\DI;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

final class Service extends \Framework\Service
{
    public function start(DI $di)
    {
        $databaseConfig = $di->get('config')->getDatabaseConfig();

        $isDevMode = true;

        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/var/lib/Doctrine/"), $isDevMode);

        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => $databaseConfig['mysql']['user'],
            'password' => $databaseConfig['mysql']['password'],
            'dbname'   => $databaseConfig['mysql']['database'],
        );

        $entityManager = EntityManager::create($dbParams, $config);
        var_dump($entityManager);
    }

    public function finish(DI $di)
    {
        return;
    }
}
