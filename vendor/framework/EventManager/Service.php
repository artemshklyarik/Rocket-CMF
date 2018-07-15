<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework\EventManager;

use Framework\DI;

/**
 * Class Service
 * @package Framework\EventManager
 */
final class Service extends \Framework\Service
{
    /**
     * @param DI $di
     */
    public function start(DI $di)
    {
        return;
    }

    /**
     * @param $name
     * @param array ...$data
     */
    public function dispatchEvent($name, &...$data)
    {
        $moduleManager = $this->di->get('module_manager');
        $events        = $moduleManager->getEvents();

        if (isset($events[$name])) {
            foreach ($events[$name] as $observer) {
                $observerObject = new $observer($this->di);
                $eventData = $observerObject->run(...$data);

                if (!is_array($eventData)) {
                    $eventData = [$eventData];
                }

                foreach ($eventData as $key => $value) {
                    $data[$key] = $value;
                }
            }
        }
    }

    /**
     * @param DI $di
     */
    public function finish(DI $di)
    {
        return;
    }
}
