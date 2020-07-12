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

namespace XyLex\Components;

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
            require $path;
        }
    }

    public static function Helper($name) {
        $path = HELPERS . $name . '.helper.php';
        if(file_exists($path)) {
            require $path;
        }
    }
    
    public static function Library($name) {
        $path = LIBRARIES . $name . '.php';
        if(file_exists($path)) {
            require $path;
        }
    }
        
    public static function Config($config_name) {
        $path = CFG_PATH . $name . '.php';
        if(file_exists($path)) {
            require $path;
        }
    }

    public static function File($path) {
        if(file_exists($path)) {
            require $path;
        }
    }
}