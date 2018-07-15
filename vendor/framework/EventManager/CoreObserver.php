<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework\EventManager;

use Framework\DI;

/**
 * Class CoreObserver
 * @package Framework\EventManager
 */
abstract class CoreObserver
{
    /**
     * @var DI
     */
    private $di;

    /**
     * CoreObserver constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
    }
}
