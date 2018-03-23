<?php

namespace Framework\ModuleManager;

use Framework\DI;

final class Service extends \Framework\Service
{
    public function start(DI $di)
    {
        $configService = $di->get('config');

        $modules = $configService->getModulesConfigs();
    }

    public function finish(DI $di)
    {
        return;
    }
}
