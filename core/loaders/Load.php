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

class Load {
    public static function Controller($name) {
        $path = CONTROLLERS . $name . '.php';
        if(file_exists($path)) {
            require $path;
        }
    }
    
    public static function Model($name) {
        $path = MODELS . $name . '.php';
        if(file_exists($path)) {
            require_once $path;
        }
    }

    public static function Helper($name, $core = false) {
        $path = HELPERS . $name . '.helper.php';
        if(!$core) {
            if(file_exists($path)) {
                require_once $path;
            } else if(file_exists($path = CORE_PATH . 'components/helpers/' . $name . '.helper.php')) {
                require_once $path;
            }
        } else if(file_exists($path = CORE_PATH . 'components/helpers/' . $name . '.helper.php')) {
            require_once $path;
        }
    }
    
    public static function Library($name, $core = false) {
        $path = LIBRARIES . $name . '.php';
        if(!$core) {
            if(file_exists($path)) {
                require_once $path;
            } else if(file_exists($path = CORE_PATH . 'components/libraries/' . $name . '.php')) {
                require_once $path;
            }
        } else if(file_exists($path = CORE_PATH . 'components/libraries/' . $name . '.php')) {
            require_once $path;
        }
    }
        
    public static function Config($config_name) {
        $path = CFG_PATH . $config_name . '.php';
        if(file_exists($path)) {
            require_once $path;
        }
    }

    public static function Driver($driver_path) {
        $path = CORE_PATH . 'components/drivers/' . $driver_path . '.driver.php';
        if(file_exists($path)) {
            require_once $path;
        }
    }
    
    public static function Service($service) {
        $path = CORE_PATH . 'components/services/' . $service . '.php';
        if(file_exists($path)) {
            require_once $path;
        }
    }
        
    public static function Component($component) {
        $path = CORE_PATH . 'components/' . $component . '.php';
        if(file_exists($path)) {
            require_once $path;
        }
    }

    public static function File($path) {
        if(file_exists($path)) {
            require_once $path;
        }
    }
}