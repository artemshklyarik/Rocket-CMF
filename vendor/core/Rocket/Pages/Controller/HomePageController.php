<?php

namespace Core\Rocket\Pages\Controller;

use Framework\ModuleManager\CoreController;

class HomePageController extends CoreController
{
    public function run()
    {
        echo '<pre>';
        var_dump('Home Page Controller');
        echo '</pre>';
        echo '<pre>';
        var_dump($this->getRequestData());
        echo '</pre>';
    }
}
