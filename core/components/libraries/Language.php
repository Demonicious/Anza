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

namespace Anza\Libraries;

class Language {
    private $language;
    private $vars_path;
    private $lang_vars;
    
    public function __construct($language, $vars_path) {
        $this->language  = $language;
        $this->vars_path = $vars_path . DIRECTORY_SEPARATOR;

        $this->lang_vars = array();
    }

    public function load($name) {
        if(is_array($name)) {
            foreach($name as $file) {
                require $this->vars_path . $this->language . DIRECTORY_SEPARATOR . $file . '.lang.php';
            }
        } else
            require $this->vars_path . $this->language . DIRECTORY_SEPARATOR . $name . '.lang.php';
        
        $this->lang_vars = array_merge($this->lang_vars, $lang);
    }

    public function Get($name) {
        return 
        isset($this->lang_vars[$name]) ? 
        $this->lang_vars[$name] :  null;
    }
}