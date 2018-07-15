<?php

namespace Core\Rocket\Pages\Controller;

use Framework\ModuleManager\CoreController;

class PageController extends CoreController
{
    public function run()
    {
        echo '<pre>';
        var_dump('Page Controller');
        echo '</pre>';
        echo '<pre>';
        var_dump($this->getRequestData());
        echo '</pre>';
    }
}
