<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework\ModuleManager;

use Framework\DI;

/**
 * Class CoreController
 * @package Framework\ModuleManager
 */
abstract class CoreRouter
{
    /**
     * @var DI
     */
    private $di;

    /**
     * CoreController constructor.
     * @param DI $di
     * @param null $getData
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    /**
     * @return DI
     */
    public function getDi(): DI
    {
        return $this->di;
    }

    /**
     * @param $simpleUrl
     * @return $simpleUrl
     */
    abstract public function run($simpleUrl);
}