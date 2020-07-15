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

namespace Anza\Libraries;

class Upload {
    private $allowed_mimes;
    private $path;
    
    public function __construct($config) {
        $this->filename      = isset($config['filename']) ? $config['filename'] : null;
        $this->max_size      = isset($config['max_size']) ? $config['max_size'] : null;
        $this->allowed_mimes = isset($config['allowed_mimes']) ? $config['allowed_mimes'] : '*';
        $this->path          = $config['path'];
    }
}