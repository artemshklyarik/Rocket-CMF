<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework\Router;

use Framework\DI;

/**
 * Class Service
 * @package Framework\Router
 */
final class Service extends \Framework\Service
{
    const FRONTEND_CONFIG_ROUTES = 'frontend';
    const ADMIN_CONFIG_ROUTE     = 'admin';

    /**
     * @param DI $di
     */
    public function start(DI $di)
    {
        $moduleManager = $di->get('module_manager');
        $routes        = $moduleManager->getRoutes();
        $request       = $di->get('http');
        $eventManager  = $di->get('event_manager');
        $uri           = $request->getUri();
        $isAdmin       = $request->isAdmin();

        if (!$isAdmin) {
            $routes = $routes[self::FRONTEND_CONFIG_ROUTES];
        } else {
            unset($uri[0]);
            $routes = $routes[self::ADMIN_CONFIG_ROUTE];
        }

        $controller = null;

        //trying to get controller by simple route
        $simpleUrl = implode('/', $uri);

        // Routers. Works only for front view
        if (!$isAdmin) {
            $allRouters = $di->get('module_manager')->getRouters();

            foreach ($allRouters as $sortOrder => $routers) {
                foreach ($routers as $routerPath) {
                    $router = new $routerPath($di);
                    $simpleUrl = $router->run($simpleUrl);
                }
            }
        }

        if (!$simpleUrl) {
            $simpleUrl = 'index';
        }

        if (isset($routes[$simpleUrl])) {
            if (class_exists($routes[$simpleUrl])) {
                $controller = new $routes[$simpleUrl]($di);
            }
        } else {
            // try to find by variable
            $minVaraible = 0;
            foreach ($routes as $route => $controllerPath) {
                $route = explode('/', $route);
                if (count($route) == count($uri)) {
                    $result = true;
                    $currentVaraibles = 0;

                    foreach ($route as $key => $routeItem) {
                        $thisVariables = [];
                        if ($route[$key] == $uri[$key]) {
                            continue;
                        } else {
                            if (stristr($route[$key], '{') && stristr($route[$key], '}') && is_numeric($uri[$key])) {
                                $currentVaraibles++;
                                $varaibleName = str_replace('{', '', $route[$key]);
                                $varaibleName = str_replace('}', '', $varaibleName);
                                $thisVariables[$varaibleName] = $uri[$key];
                            } else {
                                $result = false;
                                break;
                            }
                        }
                    }

                    if ($result && (!$minVaraible || $thisVariables < $minVaraible)) {
                        $successRoute = implode('/', $route);
                        $minVaraible  = $currentVaraibles;
                        $varaibles    = $thisVariables;
                    }
                }
            }

            if ($successRoute && $varaibles) {
                if (class_exists($routes[$simpleUrl])) {
                    $controller = new $routes[$successRoute]($di, $varaibles);
                }
            }
        }

        if ($controller) {
            $controller->run();
        } else {
            // TODO: create 404
            exit('page not found');
        }
    }

    public function finish(DI $di)
    {
        return;
    }
}
