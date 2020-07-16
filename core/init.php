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

namespace Anza;

define('ROOT_PATH', \Anza\Config\Paths::Root);
define('CORE_PATH', \Anza\Config\Paths::Core);
define('APP_PATH',  \Anza\Config\Paths::App);
define('SRC_PATH',  \Anza\Config\Paths::Src);
define('CFG_PATH',  \Anza\Config\Paths::Config);

define('LIBRARIES',   \Anza\Config\Paths::Libraries);
define('HELPERS',     \Anza\Config\Paths::Helpers);
define('CONTROLLERS', \Anza\Config\Paths::Controllers);
define('MODELS',      \Anza\Config\Paths::Models);
define('VIEWS',       \Anza\Config\Paths::Views);

require(CORE_PATH . 'environment.php');
require(CFG_PATH  . 'Autoload.php');

require(CORE_PATH . 'components/utils/InputReciever.php');
require(CORE_PATH . 'components/utils/IncomingRequest.php');

require(CORE_PATH . 'classes/Controller.php');
require(CORE_PATH . 'classes/Model.php');
require(CORE_PATH . 'classes/View.php');

require(CORE_PATH . 'loaders/requirers/Helper.php');
require(CORE_PATH . 'loaders/instantiators/Model.php');
require(CORE_PATH . 'loaders/instantiators/Config.php');
require(CORE_PATH . 'loaders/instantiators/Drivers.php');
require(CORE_PATH . 'loaders/instantiators/Libraries.php');
require(CORE_PATH . 'loaders/instantiators/Services.php');

require(CFG_PATH . 'Constants.php');

require(CORE_PATH . 'Anza.php');