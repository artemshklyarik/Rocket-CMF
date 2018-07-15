<?php

namespace Core\Rocket\Pages\Controller\Admin;

use Framework\ModuleManager\AdminController;

class DashboardController extends AdminController
{
    public function run()
    {
        $this->renderPage();
    }
}
