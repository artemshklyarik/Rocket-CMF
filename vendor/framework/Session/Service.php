<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework\Session;

use Framework\DI;

/**
 * Class Service
 * @package Framework\Session
 */
final class Service extends \Framework\Service
{
    public function start(DI $di)
    {
        session_start();
    }

    public function finish(DI $di)
    {
        unset($_SESSION['flash']);

        return;
    }
}
