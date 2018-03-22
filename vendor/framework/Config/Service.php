<?php

namespace Framework\Config;

use Framework\DI;

final class Service extends \Framework\Service
{
    CONST GENERAL_CONFIG = 'general.php';

    CONST DATABASE_CONFIG = 'database.php';

    protected $generalConfig;

    protected $databaseConfig;

    public function start(DI $di)
    {
        $configFolder         = $di->get('file_manager')->getFolderPath('config');
        $this->generalConfig  = include $configFolder . self::GENERAL_CONFIG;
        $this->databaseConfig = include $configFolder . self::DATABASE_CONFIG;
    }

    public function finish(DI $di)
    {
        // TODO: Implement finish() method.
    }
}
