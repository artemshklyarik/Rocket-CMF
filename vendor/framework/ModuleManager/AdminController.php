<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework\ModuleManager;

use Framework\DI;

/**
 * Class AdminController
 * @package Framework\ModuleManager
 */
abstract class AdminController extends CoreController
{
    /**
     * @var string
     */
    protected $layout = 'layout-2columns-left';

    /**
     * AdminController constructor.
     * @param DI $di
     * @param null $getData
     */
    public function __construct(DI $di, $getData = null)
    {
        parent::__construct($di, $data);
    }
}