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

class InputReciever {
    public function data($var = null) {
        if(!$var) return $_REQUEST;
        else 
            return isset($_REQUEST[$var]) ? $_REQUEST[$var] : null;
    }

    public function get($var = null) {
        if(!$var) return $_GET;
        else 
            return isset($_GET[$var]) ? $_GET[$var] : null;
    }
    
    public function post($var = null) {
        if(!$var) return $_POST;
        else 
            return isset($_POST[$var]) ? $_POST[$var] : null;
    }

    public function json() {
        return json_decode(file_get_contents('php://input'), true);
    }
}
