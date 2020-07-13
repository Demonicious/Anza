<?php

/* 
    XyLex - 1
    Version: 1.0.0
    Author: XL Scripts Core Team
    url: https://xlscripts.com

    XL Scripts - 2020
    This software is licensed under the MIT License.

    __   __ _       _____  _____ ______  _____ ______  _____  _____ 
    \ \ / /| |     /  ___|/  __ \| ___ \|_   _|| ___ \|_   _|/  ___|
    \ V / | |     \ `--. | /  \/| |_/ /  | |  | |_/ /  | |  \ `--. 
    /   \ | |      `--. \| |    |    /   | |  |  __/   | |   `--. \
    / /^\ \| |____ /\__/ /| \__/\| |\ \  _| |_ | |      | |  /\__/ /
    \/   \/\_____/ \____/  \____/\_| \_| \___/ \_|      \_/  \____/ 
                                                                        
*/

namespace XyLex;

use \XyLex\Load;
use \XyLex\Config;
use \XyLex\Config\Autoload;

class App {    
    public function LoadConfigs() {
        foreach(Autoload::Config as $Config)  { Load::Config($Config); }
        return true;
    }

    public function LoadHelpers() {
        foreach(Autoload::Helpers as $Helper) { Load::Helper($Helper); }
        $default = array(
            'core'
        );
        foreach($default as $Helper) { Load::Helper($Helper, true); }

        return true;
    }

    public function LoadModels() {
        foreach(Autoload::Models as $Model)  { Load::Model($Model); }
        return true;
    }
    
    public function LoadLibraries() {
        foreach(Autoload::Libraries as $Library)  { Load::Library($Library); }
        return true;
    }


    public function LoadClasses() {
        foreach(Autoload::Classes as $Class) { Load::File($Class); }
        return true;
    }

    public function InitializeRouter() {
        $routes = Config::Load('Routes');
        Load::File(CORE_PATH . 'third_party/nikic-fast-route/bootstrap.php');
        $this->router = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) use ($routes) {
            foreach($routes->routes as $new_route) {
                $r->addRoute($new_route[0], $new_route[1], $new_route[2]);
            }
        });

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri    = $_SERVER['REQUEST_URI'];

        if($routes->is_subfolder) {
            $this->uri = substr($this->uri, (strlen(rtrim($routes->is_subfolder, '/'))));
        }

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($this->uri, '?')) {
            $this->uri = substr($this->uri, 0, $pos);
        }
        $this->uri = rawurldecode($this->uri);
        $this->controller_namespace = $routes->controller_namespace;
    }

    public function DispatchRoute() {
        $this->route_info = $this->router->dispatch($this->method, $this->uri);
        switch ($this->route_info[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                \XyLex\View::Render('not_found.php', array(), true);
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $this->route_info[1];
                \XyLex\View::Render('not_allowed.php', array(), true);
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $this->route_info[1];
                $vars = $this->route_info[2];
                
                $split = explode('::', $handler);
                $controller = $split[0];
                $method     = $split[1];

                Load::Controller($controller);
                $controller = $this->controller_namespace . '\\' . $controller;
                $controller = new $controller();

                $controller->$method($vars);
                break;
        }
    }

    public function Bootstrap() {
        $this->LoadConfigs();
        $this->LoadHelpers();
        $this->LoadModels();
        $this->LoadLibraries();
        $this->LoadClasses();
    
        $this->InitializeRouter();
        $this->DispatchRoute();

        return true;
    }
}