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

class Paths {
    const Root = FC_PATH . DIRECTORY_SEPARATOR;
    const Core = FC_PATH . 'core' . DIRECTORY_SEPARATOR;
    const App  = FC_PATH . 'app' . DIRECTORY_SEPARATOR;
    const Src  = FC_PATH . 'app/src' . DIRECTORY_SEPARATOR;

    const Config      = Paths::App . 'config' . DIRECTORY_SEPARATOR;
    const Libraries   = Paths::App . 'libraries' . DIRECTORY_SEPARATOR;
    const Helpers     = Paths::App . 'helpers' . DIRECTORY_SEPARATOR;
    const Controllers = Paths::Src . 'controllers' . DIRECTORY_SEPARATOR;
    const Models      = Paths::Src . 'models' . DIRECTORY_SEPARATOR;
    const Views       = Paths::Src . 'views' . DIRECTORY_SEPARATOR;
}