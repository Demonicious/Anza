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
namespace Anza\Config;

// See https://xlscripts.github.io/Anza/routing for Configuration Instructions - Default settings are the *Recommended* Settings.

class Routes {
    public function __construct() {
        $this->is_subfolder           = '/anza'; // If you're hosting the project in a subfolder, Enter the full path to the subfolder (Without Trailing Slash)

        $this->default_controller     = 'Main';  // This controller will serve as the homepage for the User.
        $this->default_method         = 'index'; // This method will automatically be called when no method is specified. Also used in Auto-routing

        $this->auto_routing           = FALSE; // Set this to true for Automatic File Based routing - This does not have any performance impacts.

        $this->spread_arguments       = FALSE; // By default an array of params is passed to the function, setting this to true will "spread" the parameters instead. Keeping this False is recommended.

        $this->override_404           = null; // Enter the Controller::Method that should be used as the 404 Page instead of the default one.
        $this->override_403           = null; // Enter the Controller::Method that should be used as the 403 Page instead of the default one.

        /* Array of Routes - Each route is an array that contains the Method, location and handler for the route */
        $this->routes = array(
            // [ 'GET', '/user/{id}', 'Users::Profile' ]
            
            /* The first element of the Route array can be another array containing multiple allowed methods */
            // [  ['GET', 'POST'], '/user/{id}', 'Users::Profile'  ]
        
            // Anza 1.0 relies on FastRoute by Nikic. See https://github.com/nikic/FastRoute for help with creating Routes.
        );
    }
}
