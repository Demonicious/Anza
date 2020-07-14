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

define('NAME',        'XyLex');
define('VERSION',     '1.0');
define('MIN_PHP',     '7.1');

if(phpversion() < MIN_PHP)
    die(NAME . " " . VERSION . " is designed to work with PHP " . MIN_PHP . " and up.");


// Application Environment - 'production' | 'development' -- Development Mode Enables Developer Statistics and Information accessible in the Browser's Console.
define('ENV',      'development');

// Defining Basic Path Constants.
define('FC_PATH',   __DIR__ . DIRECTORY_SEPARATOR);

require(FC_PATH . 'app/config/paths.php');
require(FC_PATH . 'core/init.php');

$App = new \XyLex\App();
$App->Bootstrap();