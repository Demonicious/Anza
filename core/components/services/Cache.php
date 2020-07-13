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
use XyLex\Drivers\Cache as CacheDrivers;

class Cache {
    private $driver;

    public function __construct() {
        $cfg = Config::Load('Cache');

        if($cfg->driver == 'file')
            $this->driver = CacheDrivers::File($cfg->prefix, $cfg->path);
    }

    public function delete($cache_var) {
        return $this->driver->delete($cache_var);
    }
    
    public function clean() {
        return $this->driver->clean();
    }

    public function get($cache_var) {
        if(is_array($cache_var)) {
            if($data = $this->driver->get_multiple($cache_var))
                return $data;
        } else if($data = $this->driver->get_one($cache_var))
                return $data;

        return null;
    }

    public function save($cache_var, $val = null, $expire = 86400) {
        if(is_array($cache_var)) {
            if($this->driver->save_multiple($cache_var))
                return true;
        } else 
            if($this->driver->save_one($cache_var, $val, $expire))
                return true;

        return null;
    }
}