<?php

namespace Core\Rocket\Pages\Controller;

use Framework\ModuleManager\CoreRouter;

class Router extends CoreRouter
{
    public function run($simpleUrl)
    {
        // @TODO: add url rewrite actions

        return $simpleUrl;
    }
}
