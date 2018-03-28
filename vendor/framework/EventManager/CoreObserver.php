<?php

namespace Framework\EventManager;


use Framework\DI;

abstract class CoreObserver
{
    private $di;

    public function __construct(DI $di)
    {
        $this->di = $di;
    }
}
