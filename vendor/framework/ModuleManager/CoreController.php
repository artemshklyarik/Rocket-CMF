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
abstract class CoreController
{
    /**
     * @var DI
     */
    private $di;

    /**
     * @var null
     */
    private $getData;

    /**
     * @var string
     */
    protected $theme = 'basic';

    /**
     * @var string
     */
    protected $layout;

    /**
     * @var boolean
     */
    protected $isAdmin;

    /**
     * CoreController constructor.
     * @param DI $di
     * @param null $getData
     */
    public function __construct(DI $di, $getData = null)
    {
        $this->di      = $di;
        $this->getData = $getData;
        $this->isAdmin = $di->get('http')->isAdmin();
    }

    /**
     * @return mixed
     */
    abstract public function run();

    /**
     * @return null
     */
    public function getRequestData()
    {
        return $this->getData;
    }

    /**
     * @return DI
     */
    public function getDi(): DI
    {
        return $this->di;
    }

    /**
     * Render page
     */
    protected function renderPage()
    {
        $templatesManager = $this->di->get('templates_manager');
        $templatesManager->renderTemplate();
    }
}