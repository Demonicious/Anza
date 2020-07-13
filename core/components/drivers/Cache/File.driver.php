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

namespace XyLex\Drivers\Cache;

class File {
    public function __construct($prefix, $path) {
        $this->prefix = $prefix;
        $this->path   = $path . DIRECTORY_SEPARATOR;

        if(!is_writable($this->path)) {
            echo 'Specified Directory for Cache is not writable.';
            exit;
        }
    }

    public function clean() {
        $files = glob($this->path . '*');
        foreach($files as $file)
            if(is_file($file))
                unlink($file);
        return true;
    }

    public function delete($cv) {
        if(file_exists($this->path . $this->prefix . $cv))
            return $this->delete_unsafe($cv);
        return null;
    }

    public function delete_unsafe($cv) {
        return unlink($this->path . $this->prefix . $cv);
    }

    public function save_one($cv, $val, $expiry) {
        $now = time();
        $contents = json_encode(array(
            'time'   => $now,
            'expiry' => $now + $expiry,
            'data'   => $val
        ));

        return file_put_contents($this->path . $this->prefix . $cv, $contents);
    }

    public function save_multiple($arr_cv, $expiry = null) {
        foreach($arr_cv as $cv) {
            $this->save_one($cv['name'], $cv['data'], $expiry ? $expiry : $cv['expiry']);
        }

        return true;
    }

    public function get_one($cv) {
        if(file_exists($this->path . $this->prefix . $cv)) {
            $data = json_decode(file_get_contents($this->path . $this->prefix . $cv), true);
            if($data) {
                if(time() > $data['expiry'])
                    $this->delete_unsafe($cv);
                
                return $data['data'];
            }
        }

        return null;
    }

    public function get_multiple($arr_cv) {
        $data = array();
        foreach($arr_cv as $cv) {
            $data[$cv] = $this->get_one($cv);
        }

        if(count($data) > 0)
            return $data;

        return null;
    }
}