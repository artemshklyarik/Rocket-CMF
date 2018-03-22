<?php

namespace Framework;

abstract class Service
{
    protected $di;

    abstract protected function start(DI $di);

    abstract protected function finish(DI $di);

    public function __construct(DI $di)
    {
        $this->di = $di;
    }
}