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

define('ROOT_PATH', \XyLex\Config\Paths::Root);
define('CORE_PATH', \XyLex\Config\Paths::Core);
define('APP_PATH',  \XyLex\Config\Paths::App);
define('SRC_PATH',  \XyLex\Config\Paths::Src);
define('CFG_PATH',  \XyLex\Config\Paths::Config);

define('LIBRARIES',   \XyLex\Config\Paths::Libraries);
define('HELPERS',     \XyLex\Config\Paths::Helpers);
define('CONTROLLERS', \XyLex\Config\Paths::Controllers);
define('MODELS',      \XyLex\Config\Paths::Models);
define('VIEWS',       \XyLex\Config\Paths::Views);

require(CORE_PATH . 'components/Load.php');
require(CFG_PATH  . 'Autoload.php');

require(CORE_PATH . 'components/InputReciever.php');
require(CORE_PATH . 'components/IncomingRequest.php');

require(CORE_PATH . 'classes/Controller.php');
require(CORE_PATH . 'classes/Model.php');
require(CORE_PATH . 'classes/View.php');
require(CORE_PATH . 'classes/ConfigLoader.php');

require(CORE_PATH . 'devx/drivers.php');
require(CORE_PATH . 'devx/libraries.php');
require(CORE_PATH . 'devx/services.php');

require(CFG_PATH . 'Constants.php');

require(CORE_PATH . 'xylex.php');