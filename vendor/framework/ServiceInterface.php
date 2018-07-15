<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework;

/**
 * Interface ServiceInterface
 * @package Framework
 */
interface ServiceInterface
{
    /**
     * @param DI $di
     * @return mixed
     */
    public function start(DI $di);

    /**
     * @param DI $di
     * @return mixed
     */
    public function finish(DI $di);
}
