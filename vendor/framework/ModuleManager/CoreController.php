<?php

namespace Framework\ModuleManager;


use Framework\DI;

abstract class CoreController
{
    private $di;

    private $getData;

    public function __construct(DI $di, $getData = null)
    {
        $this->di      = $di;
        $this->getData = $getData;
    }

    abstract public function run();

    public function getRequestData()
    {
        return $this->getData;
    }
}