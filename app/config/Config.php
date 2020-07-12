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

class Config {
    public function __construct() {
        $this->urls = array(
            'base_url'  => 'http://localhost/xylex/'
        );

        /* Used for the Session Driver */
        $this->session = array(
            'prefix' => 'xylex_sess_',  // Session Key Prefix
            'expire' => 0,              // Expiry in Seconds, 0 = Browser Close
            'path'   => APP_PATH . 'writable' . DIRECTORY_SEPARATOR . 'sessions'
        );

        /* Used for the Caching Driver */
        $this->cache   = array(
            'prefix' => 'xylex_cache_',
            'mode'   => 'file',
            'path'   => APP_PATH . 'writable' . DIRECTORY_SEPARATOR . 'cache'
        );


    }
}