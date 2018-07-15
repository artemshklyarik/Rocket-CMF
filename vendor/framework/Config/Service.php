<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework\Config;

use Framework\DI;

/**
 * Class Service
 * @package Framework\Config
 */
final class Service extends \Framework\Service
{
    /**
     * String constants
     */
    CONST GENERAL_CONFIG       = 'general.php';
    CONST DATABASE_CONFIG      = 'database.php';
    CONST MODULE_CONFIG_FOLDER = 'config/';
    CONST MODULE_CONFIG        = 'config.php';
    CONST MODULE_EVENTS        = 'events.php';
    CONST MODULE_REWRITES      = 'rewrites.php';
    CONST MODULE_ROUTES        = 'routes.php';
    CONST MODULE_ROUTERS       = 'routers.php';
    CONST CORE_MODULES_SCOPE   = 'core';
    CONST CUSTOM_MODULES_SCOPE = 'custom';

    /**
     * @var array
     */
    protected $generalConfig;

    /**
     * @var array
     */
    protected $databaseConfig;

    /**
     * @param DI $di
     */
    public function start(DI $di)
    {
        $configFolder         = $di->get('file_manager')->getFolderPath('config');
        $this->generalConfig  = include $configFolder . self::GENERAL_CONFIG;
        $this->databaseConfig = include $configFolder . self::DATABASE_CONFIG;
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
    public function getGeneralConfig()
    {
        return $this->generalConfig;
    }

    /**
     * @return array
     */
    public function getDatabaseConfig()
    {
        return $this->databaseConfig;
    }

    /**
     * Get all modules configs
     * @return array
     */
    public function getModulesConfigs()
    {
        $fileManagerService   = $this->di->get('file_manager');
        $coreModulesFolder    = $fileManagerService->getCoreModulesFolder();
        $customModulesFolder  = $fileManagerService->getCustomModulesFolder();

        $files = [
            self::MODULE_CONFIG,
            self::MODULE_EVENTS,
            self::MODULE_REWRITES,
            self::MODULE_ROUTES,
            self::MODULE_ROUTERS
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

    /**
     * Check if module enabled
     *
     * @param $moduleName
     * @param string $scope
     * @return mixed
     */
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

    /**
     * Get module configs
     *
     * @param $moduleName
     * @param string $scope
     * @return array
     */
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

        $moduleConfig   = include $path . self::MODULE_CONFIG;
        $moduleEvents   = file_exists($path . self::MODULE_EVENTS) ? include $path . self::MODULE_EVENTS : null;
        $moduleRewrites = file_exists($path . self::MODULE_REWRITES) ? include $path . self::MODULE_REWRITES : null;
        $moduleRoutes   = file_exists($path . self::MODULE_ROUTES) ? include $path . self::MODULE_ROUTES : null;
        $moduleRouters  = file_exists($path . self::MODULE_ROUTERS) ? include $path . self::MODULE_ROUTERS : null;

        return [
            str_replace('.php', '', self::MODULE_CONFIG)   => $moduleConfig,
            str_replace('.php', '', self::MODULE_EVENTS)   => $moduleEvents,
            str_replace('.php', '', self::MODULE_REWRITES) => $moduleRewrites,
            str_replace('.php', '', self::MODULE_ROUTES)   => $moduleRoutes,
            str_replace('.php', '', self::MODULE_ROUTERS)  => $moduleRouters
        ];
    }
}
