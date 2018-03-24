<?php

namespace Framework\ModuleManager;

use Framework\DI;

final class Service extends \Framework\Service
{
    private $modules = [];

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

        echo '<pre>';
        var_dump($this->modules);
        echo '</pre>';
    }

    public function finish(DI $di)
    {
        return;
    }
}
