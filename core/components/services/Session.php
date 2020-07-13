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
use XyLex\Drivers\Session as SessionDrivers;

class Session {
    private $driver;

    public function __construct() {
        $cfg = Config::Load('Session');

        if($cfg->driver == 'vanilla')
            $this->driver = SessionDrivers::Vanilla($cfg->prefix, $cfg->expiry);
    }

    public function set($fields, $val = null) {
        if(is_array($fields))
            return $this->driver->set_fields($fields);
        else return $this->driver->set_fields($fields, $val);
    }

    public function get($fields) {
        return $this->driver->get_fields($fields);
    }

    public function set_flash($fields, $val = null) {
        if(is_array($fields))
            return $this->driver->set_flash_fields($fields);
        else return $this->driver->set_flash_fields($fields, $val);
    }

    public function get_flash($fields) {
        return $this->driver->get_flash_fields($fields);
    }

    public function unset($fields) {
        if(is_array($fields)) {
            return $this->driver->unset_fields($fields);
        } else {
            return $this->driver->unset_field($fields);
        }
    }

    public function destroy() {
        return $this->driver->destroy_session();
    }
}