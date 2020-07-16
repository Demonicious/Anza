<?php

/* 
    Anza - 1
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

namespace Anza;

use \Anza\Load;
use \Anza\Config;
use \Anza\Config\Autoload;

class App {
    private $override_404 = null;
    private $override_403 = null;
    private $controller_namespace = '\Anza\Controllers';

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

        $this->default_controller = $routes->default_controller;
        $this->default_method     = $routes->default_method;
        $this->spread_arguments   = $routes->spread_arguments;

        Load::File(CORE_PATH . 'third_party/nikic-fast-route/bootstrap.php');
        $this->router = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) use ($routes) {
            $r->addRoute(['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD'], '/' , $routes->default_controller . '::' . $routes->default_method);

            foreach($routes->routes as $new_route) {
                $r->addRoute($new_route[0], $new_route[1], $new_route[2]);
            }

            if($routes->auto_routing) {
                $r->addRoute(['GET','POST','PUT','PATCH','DELETE', 'HEAD'], '/{controller}', 'auto');
                $r->addRoute(['GET','POST','PUT','PATCH','DELETE', 'HEAD'], '/{controller}/{method}', 'auto');
                $r->addRoute(['GET','POST','PUT','PATCH','DELETE', 'HEAD'], '/{controller}/{method}/{vars:.+}', 'auto');
            }
        });
        

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri    = $_SERVER['REQUEST_URI'];

        if($routes->is_subfolder) {
            $this->uri = substr($this->uri, (strlen(rtrim($routes->is_subfolder, '/'))));
        }

        $this->override_404 = $routes->override_404;
        $this->override_403 = $routes->override_403;

        if (false !== $pos = strpos($this->uri, '?')) {
            $this->uri = substr($this->uri, 0, $pos);
        }
        $this->uri = str_replace('\\', '/', rawurldecode($this->uri));
        if($this->uri != '/') $this->uri = rtrim($this->uri, '/');
    }

    public function Show404() {
        if($this->override_404) {
            $split = explode('::', $this->override_404);
            $controller = $split[0];
            $method     = isset($split[1]) ? $split[1] : $this->default_method;

            Load::Controller($controller);
            $controller = $this->controller_namespace . '\\' . $controller;
            $controller = new $controller();
            $controller->$method();
        } else
            \Anza\View::Render('not_found.php', array(), true);
    }
    
    public function Show403() {
        $allowedMethods = $this->route_info[1];
        if($this->override_403) {
            $split = explode('::', $this->override_403);
            $controller = $split[0];
            $method     = isset($split[1]) ? $split[1] : null;

            Load::Controller($controller);
            $controller = $this->controller_namespace . '\\' . $controller;
            $controller = new $controller();
            $controller->$method();
        } else
            \Anza\View::Render('not_allowed.php', array(), true);
    }

    public function DispatchAutoRoute() {
        $controller = ucfirst($this->vars['controller']);
        $method     = isset($this->vars['method']) && $this->vars['method'] != '' ? $this->vars['method'] : $this->default_method;
        $vars       = isset($this->vars['vars']) && $this->vars['vars'] != '' ? explode('/', $this->vars['vars']) : null;

        Load::Controller($controller);
        $controller = $this->controller_namespace . '\\' . $controller;
        if(class_exists($controller)) {
            $controller = new $controller();
            if(method_exists($controller, $method) || $method[0] == '_') {
                if($this->spread_arguments)
                    call_user_func_array(array($controller, $method), $vars);
                else 
                    $controller->$method($vars);
            } else 
                $this->Show404();
        } else
            $this->Show404();
    }

    public function DispatchDefinedRoute() {
        $split      = explode('::', $this->handler);
        $controller = $split[0];
        $method     = isset($split[1]) ? $split[1] : $this->default_method;         

        Load::Controller($controller);
        $controller = $this->controller_namespace . '\\' . $controller;
        $controller = new $controller();
            
        if($this->spread_arguments)
            call_user_func_array(array($controller, $method), $this->vars);
        else 
            $controller->$method($this->vars);
    }

    public function DispatchRoute() {
        $this->route_info = $this->router->dispatch($this->method, $this->uri);

        switch ($this->route_info[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                $this->Show404();
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $this->Show403();
                break;
            case \FastRoute\Dispatcher::FOUND:
                $this->handler    = $this->route_info[1];
                $this->vars       = $this->route_info[2];

                if($this->handler == 'auto') 
                    $this->DispatchAutoRoute();
                else 
                    $this->DispatchDefinedRoute();
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

        if(ENV == 'development') {
            if(ENV == 'development') {
                $time_taken = microtime(true) - $GLOBALS['start'];
                \Anza\View::Render('_dev_script', array(
                    'time_taken' => $time_taken,
                    'route_info' => json_encode(array(
                        'status' => $this->route_info[0] ? 'Found' : 'Error',
                        'handler' => isset($this->route_info[1]) ? $this->route_info[1] : 'undefined',
                        'variables' => isset($this->vars) ? $this->vars : 'undefined'
                    ))
                ), true);
            }
        }

        return true;
    }
}