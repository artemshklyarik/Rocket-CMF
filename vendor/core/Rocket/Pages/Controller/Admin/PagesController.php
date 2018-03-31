<?php

namespace Core\Rocket\Pages\Controller\Admin;

use Framework\ModuleManager\AdminController;

class PagesController extends AdminController
{
    public function run()
    {
        echo '<pre>';
        var_dump('Admin Pages Controller');
        echo '</pre>';
    }
}
