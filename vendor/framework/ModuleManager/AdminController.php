<?php

namespace Framework\ModuleManager;


use Framework\DI;

abstract class AdminController extends CoreController
{
    protected $layout = 'layout-2columns-left';

    public function __construct(DI $di, $getData = null)
    {
        parent::__construct($di, $data);
    }
}