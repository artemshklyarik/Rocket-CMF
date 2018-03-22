<?php

namespace Framework\DB;

use Framework\DI;

final class Service extends \Framework\Service
{
    private $dbh;

    public function start(DI $di)
    {
        // TODO: Implement start() method.
    }

    public function finish(DI $di)
    {
        $this->dbh = null;
    }
}
