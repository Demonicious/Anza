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

use \Anza\Load;

class Libraries {
    public static function Language($a, $b) {
        Load::Library('Language', true);
        return new \Anza\Libraries\Language($a, $b);
    }

    public static function Upload($cfg) {
        Load::Library('Upload', true);
        return new \Anza\Libraries\Upload($cfg);
    }

    public static function Load($name) {
        Load::Library($name);
        $name = '\\Anza\\Libraries\\' . $name;
        return new $name(...$args);
    }
}