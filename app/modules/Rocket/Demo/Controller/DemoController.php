<?php

namespace Module\Rocket\Demo\Controller;

use Framework\ModuleManager\CoreController;

class DemoController extends CoreController
{
    public function run()
    {
        echo '<pre>';
        var_dump('Demo Controller');
        echo '</pre>';
        echo '<pre>';
        var_dump($this->getRequestData());
        echo '</pre>';
    }
}