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

/* DEVELOPMENT MODE LOADER */

namespace Anza;

$GLOBALS['load_log'] = array();

class Load {
    public static function GenerateBacktrace() {
        $bt = \debug_backtrace();
        return $bt[3];
    }
    
    public static function Controller($name) {
        $path = CONTROLLERS . $name . '.php';
        if(file_exists($path)) {
            array_push($GLOBALS['load_log'], array(
                'type' => 'Controller',
                'name' => $name,
                'complete' => json_encode(\debug_backtrace())
            ));
            require $path;
        }
    }
    
    public static function Model($name) {
        $path = MODELS . $name . '.php';
        if(file_exists($path)) {
            array_push($GLOBALS['load_log'], array(
                'type' => 'Model',
                'name' => $name,
                'complete' => json_encode(debug_backtrace())
            ));
            require_once $path;
        }
    }

    public static function Helper($name, $core = false) {
        $path = HELPERS . $name . '.helper.php';
        if(!$core) {
            if(file_exists($path)) {
                array_push($GLOBALS['load_log'], array(
                    'type' => 'Custom Helper',
                    'name' => $name,
                    'complete' => json_encode(debug_backtrace())
                ));
                require_once $path;
            } else if(file_exists($path = CORE_PATH . 'components/helpers/' . $name . '.helper.php')) {
                array_push($GLOBALS['load_log'], array(
                    'type' => 'System Helper',
                    'name' => $name,
                    'complete' => json_encode(debug_backtrace())
                ));
                require_once $path;
            }
        } else if(file_exists($path = CORE_PATH . 'components/helpers/' . $name . '.helper.php')) {
            array_push($GLOBALS['load_log'], array(
                'type' => 'System Helper',
                'name' => $name,
                'complete' => json_encode(debug_backtrace())
            ));
            require_once $path;
        }
    }
    
    public static function Library($name, $core = false) {
        $path = LIBRARIES . $name . '.php';
        if(!$core) {
            if(file_exists($path)) {
                array_push($GLOBALS['load_log'], array(
                    'type' => 'Custom Library',
                    'name' => $name,
                    'complete' => json_encode(debug_backtrace())
                ));
                require_once $path;
            } else if(file_exists($path = CORE_PATH . 'components/libraries/' . $name . '.php')) {
                array_push($GLOBALS['load_log'], array(
                    'type' => 'System Library',
                    'name' => $name,
                    'complete' => json_encode(debug_backtrace())
                ));
                require_once $path;
            }
        } else if(file_exists($path = CORE_PATH . 'components/libraries/' . $name . '.php')) {
            array_push($GLOBALS['load_log'], array(
                'type' => 'System Library',
                'name' => $name,
                'complete' => json_encode(debug_backtrace())
            ));
            require_once $path;
        }
    }
        
    public static function Config($config_name) {
        $path = CFG_PATH . $config_name . '.php';
        if(file_exists($path)) {
            array_push($GLOBALS['load_log'], array(
                'type' => 'Config',
                'name' => $config_name,
                'complete' => json_encode(debug_backtrace())
            ));
            require_once $path;
        }
    }

    public static function Driver($driver) {
        $path = CORE_PATH . 'components/drivers/' . $driver . '.driver.php';
        if(file_exists($path)) {
            array_push($GLOBALS['load_log'], array(
                'type' => 'Driver',
                'name' => $driver,
                'complete' => json_encode(debug_backtrace())
            ));
            require_once $path;
        }
    }
    
    public static function Service($service) {
        $path = CORE_PATH . 'components/services/' . $service . '.php';
        if(file_exists($path)) {
            array_push($GLOBALS['load_log'], array(
                'type' => 'Service',
                'name' => $service,
                'complete' => json_encode(debug_backtrace())
            ));
            require_once $path;
        }
    }
        
    public static function Component($component) {
        $path = CORE_PATH . 'components/' . $component . '.php';
        if(file_exists($path)) {            
            array_push($GLOBALS['load_log'], array(
                'type' => 'Component',
                'name' => $component,
                'complete' => json_encode(debug_backtrace())
            ));
            require_once $path;
        }
    }

    public static function File($path) {
        if(file_exists($path)) {
            array_push($GLOBALS['load_log'], array(
                'type' => 'File',
                'name' => $path,
                'complete' => json_encode(debug_backtrace())
            ));
            require_once $path;
        }
    }
}