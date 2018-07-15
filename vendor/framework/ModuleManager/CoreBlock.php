<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework\ModuleManager;

use Framework\DI;

/**
 * Class CoreBlock
 * @package Framework\ModuleManager
 */
abstract class CoreBlock
{
    /**
     * CoreBlock constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    /**
     * @return mixed
     */
    abstract public function getData();
}