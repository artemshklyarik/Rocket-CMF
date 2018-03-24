<?php

namespace Framework\ModuleManager;

use Framework\DI;

final class Service extends \Framework\Service
{
    private $modules = [];

    private $routes = [];

    private $events = [];

    private $rewrites = [];

    public function start(DI $di)
    {
        $configService = $di->get('config');
        $modules       = $configService->getModulesConfigs();

        //load enabled module's configs
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

        // initialize routes
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

        // TODO: initialize events, rewrites
    }

    public function finish(DI $di)
    {
        return;
    }

    public function getModules()
    {
        return $this->modules;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getEvents()
    {
        return $this->events;
    }

    public function getRewrites()
    {
        return $this->rewrites;
    }
}
