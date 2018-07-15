<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework\TemplatesManager;

use Framework\DI;

/**
 * Class Service
 * @package Framework\TemplatesManager
 */
final class Service extends \Framework\Service
{
    /**
     * @var string
     */
    protected $theme = 'basic';

    /**
     * @var string
     */
    protected $templateBasicPage = 'content.html';

    /**
     * @var string
     */
    protected $themeFolder;

    /**
     * @param DI $di
     */
    public function start(DI $di)
    {
        $fileManager = $di->get('file_manager');
        $isAdmin     = $di->get('http')->isAdmin();

        if ($isAdmin) {
            $this->themeFolder = $themeFolder = $fileManager->getFolderPath('theme_admin_folder') . $this->theme;
        } else {
            $this->themeFolder = $themeFolder = $fileManager->getFolderPath('theme_frontend_folder') . $this->theme;
        }
    }

    /**
     * @param null $data
     */
    public function renderTemplate($data = null)
    {
        $themeConfigs = include $this->themeFolder . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'theme.php';

    }

    /**
     * @param DI $di
     */
    public function finish(DI $di)
    {
        return;
    }
}