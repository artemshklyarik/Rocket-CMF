<?php

namespace Framework\Http;

use Framework\DI;

final class Service extends \Framework\Service
{
    /**
     * @var
     */
    private $host;

    /**
     * @var
     */
    private $uri;

    /**
     * @var
     */
    private $https;

    /**
     * @param DI $di
     */
    public function start(DI $di)
    {
        $this->setHost($_SERVER['HTTP_HOST']);
        $this->setUri(explode('/', $_GET['route']));
        $this->setHttps(!empty($_SERVER['HTTPS']) && 'off' !== strtolower($_SERVER['HTTPS']));
    }

    /**
     * @param DI $di
     */
    public function finish(DI $di)
    {
        return;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getHttps()
    {
        return $this->https;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @param mixed $https
     */
    public function setHttps($https)
    {
        $this->https = $https;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }
}
