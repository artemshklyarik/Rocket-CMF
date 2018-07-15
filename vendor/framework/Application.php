<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework;

use Framework\DI;

/**
 * Class Application
 * @package Framework
 */
class Application
{
    const SERVICES_CONFIG_PATH = 'vendor/framework/services.php';

    /**
     * Run application
     */
    public static function run()
    {
        //initialize DI
        $di = new DI();

        $services = include self::SERVICES_CONFIG_PATH;

        foreach ($services as $key => $service) {
            $serviceObject = new $service($di);
            $di->set($key, $serviceObject);
        }

        //start services
        foreach ($services as $key => $service) {
            $di->get($key)->start($di);
        }

        //finish services
        foreach ($services as $key => $service) {
            $di->get($key)->finish($di);
        }
    }
}
