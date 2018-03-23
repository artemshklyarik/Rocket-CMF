<?php

namespace Framework\DB;

use Framework\DI;

final class Service extends \Framework\Service
{
    public function start(DI $di)
    {
        $databaseConfig = $di->get('config')->getDatabaseConfig();
    }

    public function finish(DI $di)
    {
        return;
    }
}
