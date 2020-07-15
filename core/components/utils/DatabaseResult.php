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

namespace Anza\Components;

class DatabaseResult {
    private $i = -1;
    private $count;
    private $rows;
    private $last_id;
    private $status;

    public function __construct($count, $result, $id, $status) {
        $this->count   = $count;
        $this->rows    = $result;
        $this->last_id = $id;
        $this->status  = $status;
    }

    public function row() {
        $this->i += 1;
        return isset($this->rows[$this->i]) ? $this->rows[$this->i] : null;
    }

    public function result() {
        return $this->rows;
    }

    public function num_rows() {
        return $this->count;
    }

    public function status_code() {
        return $this->status['code'];
    }

    public function status_info() {
        return $this->status['info'];
    }

    public function status() {
        return $this->status;
    }

    public function insert_id() {
        return $this->last_id;
    }
}
