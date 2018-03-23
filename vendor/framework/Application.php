<?php

namespace Framework;

use Framework\DI;

class Application
{
    public static function run()
    {
        $di = new DI();

        //initialize DI
        $services = include 'vendor/framework/services.php';

        foreach ($services as $key => $service) {
            $serviceObject = new $service($di);
            $di->set($key, $serviceObject);
        }

        //start services
        foreach ($services as $key => $service) {
            $di->get($key)->start($di);
        }

//        echo '<pre>';
//        var_dump($di);
//        echo '</pre>';

        //finish services
        foreach ($services as $key => $service) {
            $di->get($key)->finish($di);
        }
    }
}
