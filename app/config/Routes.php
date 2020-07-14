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
namespace XyLex\Config;

// See https://xlscripts.github.io/xylex/routing for Configuration Instructions - Default settings are the *Recommended* Settings.

class Routes {
    public function __construct() {
        $this->is_subfolder           = '/xylex';               // If you're hosting the project in a subfolder, Enter the full path to the subfolder (Without Trailing Slash)
        $this->translate_uri_dash     = FALSE;

        $this->controller_namespace   = '\XyLex\Controllers';
        $this->default_controller     = 'Main';
        $this->default_method         = 'index';
        $this->auto_routing           = FALSE;

        $this->spread_arguments       = FALSE; 

        $this->override_404           = null;
        $this->override_403           = null;

        $this->routes = array();
    }
}
