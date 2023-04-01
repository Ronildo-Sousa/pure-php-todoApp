<?php

namespace Ronildo\TodoPhp\Controllers;

use League\Plates\Engine;

abstract class BaseController
{
    protected Engine $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../Resources/Views");
    }
}
