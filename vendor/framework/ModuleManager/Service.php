<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework\ModuleManager;

use Framework\DI;

/**
 * Class Service
 * @package Framework\ModuleManager
 */
final class Service extends \Framework\Service
{
    /**
     * @var DI $di
     */
    protected $di;

    /**
     * @var array
     */
    private $modules = [];

    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var array
     */
    private $routers = [];

    /**
     * @var array
     */
    private $events = [];

    /**
     * @var array
     */
    private $rewrites = [];

    /**
     * Load enabled modules
     */
    protected function loadModulesConfigs()
    {
        $configService = $this->di->get('config');
        $modules       = $configService->getModulesConfigs();

        foreach ($modules as $scope => $scopeModules) {
            foreach ($scopeModules as $moduleName => $configs) {
                if ($configService->isModuleEnabled($moduleName, $scope)) {
                    if (!isset($this->modules[$scope])) {
                        $this->modules[$scope] = [];
                    }

                    $this->modules[$scope][$moduleName] = $configService->getModuleConfigs($moduleName, $scope);
                }
            }
        }
    }

    /**
     * Initialize Routes
     */
    protected function initializeRoutes()
    {
        $configService = $this->di->get('config');
        $modules       = $configService->getModulesConfigs();

        foreach ($this->modules as $scope => $scopeModules) {
            foreach ($scopeModules as $moduleName => $configs) {
                $moduleRoutes = $configs[str_replace('.php', '', $configService::MODULE_ROUTES)];

                foreach ($moduleRoutes as $moduleRoutesScope => $routes) {
                    if (!isset($this->routes[$moduleRoutesScope])) {
                        $this->routes[$moduleRoutesScope] = [];
                    }

                    foreach ($routes as $urlRule => $route) {
                        $this->routes[$moduleRoutesScope][$urlRule] = $route;
                    }
                }
            }
        }
    }

    /**
     * Initialize Routers
     */
    protected function initializeRouters()
    {
        $configService = $this->di->get('config');
        $modules       = $configService->getModulesConfigs();

        foreach ($this->modules as $scope => $scopeModules) {
            foreach ($scopeModules as $moduleName => $configs) {
                $moduleRouters = $configs[str_replace('.php', '', $configService::MODULE_ROUTERS)];
                if ($moduleRouters) {
                    $this->routers[$moduleRouters['sortOrder']][] = $moduleRouters['router'];
                }
            }
        }
    }

    /**
     * Initialize Events
     */
    protected function initializeEvents()
    {
        $configService = $this->di->get('config');
        $modules       = $configService->getModulesConfigs();

        foreach ($this->modules as $scope => $scopeModules) {
            foreach ($scopeModules as $moduleName => $configs) {
                $events = $configs[str_replace('.php', '', $configService::MODULE_EVENTS)];

                foreach ($events as $eventName => $observer) {
                    if (!isset($this->events[$eventName])) {
                        $this->events[$eventName] = [];
                    }

                    $this->events[$eventName][] = $observer;
                }
            }
        }
    }

    /**
     * @param DI $di
     */
    public function start(DI $di)
    {
        $this->di = $di;

        //load enabled module's configs
        $this->loadModulesConfigs();

        // initialize routes
        $this->initializeRoutes();

        // initialize routers
        $this->initializeRouters();

        // initialize events
        $this->initializeEvents();

        // TODO: initialize rewrites
    }

    /**
     * @param DI $di
     */
    public function finish(DI $di)
    {
        return;
    }

    /**
     * @return array
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return array
     */
    public function getRouters()
    {
        return $this->routers;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @return array
     */
    public function getRewrites()
    {
        return $this->rewrites;
    }
}
