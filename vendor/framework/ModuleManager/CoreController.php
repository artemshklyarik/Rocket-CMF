<?php

namespace Framework\ModuleManager;


use Framework\DI;

abstract class CoreController
{
    private $di;

    private $getData;

    protected $theme = 'basic';

    protected $layout;

    protected $isAdmin;

    public function __construct(DI $di, $getData = null)
    {
        $this->di      = $di;
        $this->getData = $getData;
        $this->isAdmin = $di->get('http')->isAdmin();;
    }

    abstract public function run();

    public function getRequestData()
    {
        return $this->getData;
    }

    protected function getBlock($name, $template = null)
    {
        return;
    }

    protected function renderPage()
    {
        $fileManager = $this->di->get('file_manager');

        if ($this->isAdmin) {
            $themeFolder = $fileManager->getFolderPath('theme_admin_folder') . $this->theme;
        } else {
            $themeFolder = $fileManager->getFolderPath('theme_frontend_folder') . $this->theme;
        }

        $pageTemplate = $themeFolder . '/templates/page.php';

        if (file_exists($pageTemplate)) {
            include $pageTemplate;
        } else {
            exit('Theme is corrupted');
        }
    }
}