<?php

namespace Framework\Session;

use Framework\DI;

final class Service extends \Framework\Service
{
    public function start(DI $di)
    {
        session_start();
    }

    public function finish(DI $di)
    {
        return;
    }
}
