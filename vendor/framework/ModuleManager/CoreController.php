<?php


namespace Framework\ModuleManager;


use Framework\DI;

class CoreController
{
    private $di;

    private $getData;

    public function __construct(DI $di, $getData = null)
    {
        $this->di      = $di;
        $this->getData = $getData;
    }

    public function getRequestData()
    {
        return $this->getData;
    }
}