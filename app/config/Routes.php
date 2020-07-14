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

class Routes {
    public function __construct() {
        $this->is_subfolder           = '/xylex'; // If you're hosting the project in a subfolder, Enter the full path to the subfolder (Without Trailing Slash)
        $this->translate_uri_dash     = FALSE;

        $this->controller_namespace   = '\XyLex\Controllers';
        $this->allowed_methods        = array( 'GET', 'POST', 'PUT', 'PATCH', 'DELETE' );

        $this->default_controller     = 'Main';
        $this->default_method         = 'index';

        $this->auto_routing           = FALSE; // Set this to true for Automatic Routing. Auto-routing differs from Pre-defined Routing. Check Docs for More

        $this->override_404           = null;
        $this->override_403           = null;

        $this->routes = array(
            // [ 'GET', '/user/{id}', 'User::FindUser' ]
        );
    }
}
