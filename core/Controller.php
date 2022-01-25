<?php

namespace Core;

use Config\Config;
use Core\Request;

class Controller
{
    public $view, $request;
    public array $sidebar;
    private $_controllerName, $_actionName;

    public function __construct($controller, $action)
    {
        $this->_controllerName = $controller;
        $this->_actionName = $action;
        $viewPath = strtolower($controller) . DS . $action;
        $this->view = new View($viewPath);
        $this->view->setLayout(Config::get('default_layout'));
        $this->request = new Request();
        $this->onConstruct();
    }

    public function onConstruct()
    {
    }

}