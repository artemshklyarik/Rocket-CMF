<?php
/**
 * ROCKET CMS 2018, ARTEM SHKLYARIK
 * Github: https://github.com/artemshklyarik
 */

namespace Framework;

/**
 * Class DI
 * @package Framework
 */
class DI
{
    /**
     * @var array
     */
    private $containers = [];

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->containers[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->containers[$key];
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->containers[$key]);
    }
}
