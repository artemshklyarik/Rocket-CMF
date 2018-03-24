<?php

namespace Framework\FileManager;

use Framework\DI;

final class Service extends \Framework\Service
{
    CONST CONFIG_FOLDER = 'app/config/';

    CONST ASSETS_FOLDER = 'assets/';

    CONST ASSETS_CSS_FOLDER = 'assets/css/';

    CONST ASSETS_JS_FOLDER = 'assets/js/';

    CONST ASSETS_IMG_FOLDER = 'assets/img/';

    CONST MEDIA_FOLDER = 'media/';

    CONST VAR_FOLDER = 'var/';

    CONST VAR_LOGS_FOLDER = 'var/logs/';

    CONST CORE_MODULES_FOLDER = 'vendor/core/';

    CONST CUSTOM_MODULES_FOLDER = 'app/modules/';

    /**
     * @param DI $di
     */
    public function start(DI $di)
    {
        return;
    }

    /**
     * @param DI $di
     */
    public function finish(DI $di)
    {
        return;
    }

    /**
     * @param string $folder
     * @return bool|string
     */
    public function getFolderPath($folder = 'root')
    {
        switch ($folder) {
            case 'root':
                return '/';
            case 'config':
                return self::CONFIG_FOLDER;
            case 'assets':
                return self::ASSETS_FOLDER;
            case 'assets_css':
                return self::ASSETS_CSS_FOLDER;
            case 'assets_js':
                return self::ASSETS_JS_FOLDER;
            case 'assets_img':
                return self::ASSETS_IMG_FOLDER;
            case 'media':
                return self::MEDIA_FOLDER;
            case 'var':
                return self::VAR_FOLDER;
            case 'log':
                return self::VAR_LOGS_FOLDER;
            default:
                return false;
        }
    }

    /**
     * @return string
     */
    public function getCoreModulesFolder()
    {
        return self::CORE_MODULES_FOLDER;
    }

    /**
     * @return string
     */
    public function getCustomModulesFolder()
    {
        return self::CUSTOM_MODULES_FOLDER;
    }

    public function scanDir($dir, $files = null, $result = [])
    {
        foreach (scandir($dir) as $folderItem) {
            if ($folderItem == '.' || $folderItem == '..') {
                continue;
            }

            if (is_file($dir . $folderItem)) {
                if ($files && !in_array($folderItem, $files)) {
                    continue;
                }

                if (!isset($result[$dir])) {
                    $result[$dir] = [];
                }

                $result[$dir][$folderItem] = $dir . $folderItem;
            } else if (is_dir($dir . $folderItem)) {
                $result = $this->scanDir($dir . $folderItem . '/', $files, $result);
            }
        }

        return $result;
    }
}
