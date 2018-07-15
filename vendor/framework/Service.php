<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework;

/**
 * Class Service
 * @package Framework
 */
abstract class Service implements ServiceInterface
{
    /**
     * @var DI
     */
    protected $di;

    /**
     * @param DI $di
     * @return mixed
     */
    abstract public function start(DI $di);

    /**
     * @param DI $di
     * @return mixed
     */
    abstract public function finish(DI $di);

    /**
     * Service constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
    }
}