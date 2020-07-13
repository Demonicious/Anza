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

namespace XyLex\Services;

use XyLex\Config;
use XyLex\Drivers\Database as DatabaseDrivers;

class Database {
    private $driver;

    public function __construct($group = null) {
        $cfg = Config::Load('Database');

        if($cfg->driver == 'db_default') {
            $credentials = $cfg->groups[$group ? $group : $cfg->default_group];
            $this->driver = DatabaseDrivers::DB_Default($credentials);
        }
    }

    public function table($t) {
        return $this->driver->builder->table($t);
    }
}