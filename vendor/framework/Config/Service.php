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
            'core'   => $coreModulesConfigs,
            'custom' => $customModulesConfigs
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

        echo '<pre>';
        var_dump($modulesConfigs);
        echo '</pre>';
    }
}
