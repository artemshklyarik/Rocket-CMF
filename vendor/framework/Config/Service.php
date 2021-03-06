<?php

namespace Framework\Config;

use Framework\DI;

final class Service extends \Framework\Service
{
    CONST GENERAL_CONFIG       = 'general.php';

    CONST DATABASE_CONFIG      = 'database.php';

    CONST MODULE_CONFIG_FOLDER = 'config/';

    CONST MODULE_CONFIG        = 'config.php';

    CONST MODULE_EVENTS        = 'events.php';

    CONST MODULE_REWRITES      = 'rewrites.php';

    CONST MODULE_ROUTES        = 'routes.php';

    CONST CORE_MODULES_SCOPE   = 'core';

    CONST CUSTOM_MODULES_SCOPE = 'custom';

    protected $generalConfig;

    protected $databaseConfig;

    public function start(DI $di)
    {
        $configFolder         = $di->get('file_manager')->getFolderPath('config');
        $this->generalConfig  = include $configFolder . self::GENERAL_CONFIG;
        $this->databaseConfig = include $configFolder . self::DATABASE_CONFIG;
    }

    public function finish(DI $di)
    {
        return;
    }

    public function getGeneralConfig()
    {
        return $this->generalConfig;
    }

    public function getDatabaseConfig()
    {
        return $this->databaseConfig;
    }

    public function getModulesConfigs()
    {
        $fileManagerService   = $this->di->get('file_manager');
        $coreModulesFolder    = $fileManagerService->getCoreModulesFolder();
        $customModulesFolder  = $fileManagerService->getCustomModulesFolder();

        $files = [
            self::MODULE_CONFIG,
            self::MODULE_EVENTS,
            self::MODULE_REWRITES,
            self::MODULE_ROUTES
        ];

        $coreModulesConfigs   = $fileManagerService->scanDir($coreModulesFolder, $files);
        $customModulesConfigs = $fileManagerService->scanDir($customModulesFolder, $files);

        $modulesConfigs = [
            self::CORE_MODULES_SCOPE   => $coreModulesConfigs,
            self::CUSTOM_MODULES_SCOPE => $customModulesConfigs
        ];


        foreach ($modulesConfigs as &$scope) {
            foreach ($scope as $configFolderPath => $moduleConfigs) {
                $newKey = str_replace(self::MODULE_CONFIG_FOLDER, '', $configFolderPath);
                $newKey = str_replace($coreModulesFolder, '', $newKey);
                $newKey = str_replace($customModulesFolder, '', $newKey);
                $scope[$newKey] = $scope[$configFolderPath];
                unset($scope[$configFolderPath]);
            }
        }

        return $modulesConfigs;
    }

    public function isModuleEnabled($moduleName, $scope = self::CORE_MODULES_SCOPE)
    {
        $fileManagerService = $this->di->get('file_manager');

        switch ($scope) {
            case self::CORE_MODULES_SCOPE:
                $path = $fileManagerService->getCoreModulesFolder();
                break;
            case self::CUSTOM_MODULES_SCOPE:
                $path = $fileManagerService->getCustomModulesFolder();
                break;
        }

        $path .= $moduleName . self::MODULE_CONFIG_FOLDER . self::MODULE_CONFIG;
        $moduleConfig = include $path;

        return $moduleConfig['enable'];
    }

    public function getModuleConfigs($moduleName, $scope = self::CORE_MODULES_SCOPE)
    {
        $fileManagerService = $this->di->get('file_manager');

        switch ($scope) {
            case self::CORE_MODULES_SCOPE:
                $path = $fileManagerService->getCoreModulesFolder();
                break;
            case self::CUSTOM_MODULES_SCOPE:
                $path = $fileManagerService->getCustomModulesFolder();
                break;
        }

        $path .= $moduleName . self::MODULE_CONFIG_FOLDER;

        return [
            str_replace('.php', '', self::MODULE_CONFIG)   => include $path . self::MODULE_CONFIG,
            str_replace('.php', '', self::MODULE_EVENTS)   => include $path . self::MODULE_EVENTS,
            str_replace('.php', '', self::MODULE_REWRITES) => include $path . self::MODULE_REWRITES,
            str_replace('.php', '', self::MODULE_ROUTES)   => include $path . self::MODULE_ROUTES
        ];
    }
}
