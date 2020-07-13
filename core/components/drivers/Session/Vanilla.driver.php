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

namespace XyLex\Drivers\Session;

class Vanilla {
    private $session_data;
    private $flash_data;
    private $prefix;
    private $expiry;

    public function __construct($prefix, $expiry) {
        $this->prefix = $prefix;
        $this->expiry = $expiry;

        $this->_init_session();
    }

    private function _init_session() {
        if(!isset($_SESSION)) {
            session_set_cookie_params($this->expiry, '/');
            session_start();
        }

        if(!isset($_SESSION['flash'])) $_SESSION['flash'] = array();
        if(!isset($_SESSION['data']))  $_SESSION['data']  = array();

        $this->session_data = $_SESSION['data'];
        $this->flash_data   = $_SESSION['flash'];
    }

    public function set_flash_fields($fields, $value = null) {
        if(is_array($fields)) {
            foreach($fields as $field => $value) {
                $this->flash_data[$this->prefix . $field] = $value;
            }
        } else {
            $this->flash_data[$this->prefix . $fields] = $value;
        }
        
        $_SESSION['flash'] = $this->flash_data;

        return true;
    }

    public function get_flash_fields($fields) {
        $return = null;
        if(is_array($fields)) {
            $return  = array();
            foreach($fields as $field) {
                $name = $this->prefix . $field;
                if(isset($this->flash_data[$name])) {
                    $return[$field] = $this->flash_data[$name];
                    unset($this->flash_data[$name]);
                } else $return[$field] = null;
            }
        } else if(!empty($fields)) {
            $name = $this->prefix . $fields;
            if(isset($this->flash_data[$name])) {
                $return = $this->flash_data[$name];
                unset($this->flash_data[$name]);
            }
        }
    
        $_SESSION['flash'] = $this->flash_data;
        return $return;
    }

    public function set_fields($fields, $value = null) {
        if(is_array($fields)) {
            foreach($fields as $field => $value) {
                $this->session_data[$this->prefix . $field] = $value;
            }
        } else {
            $this->session_data[$this->prefix . $fields] = $value;
        }
        
        $_SESSION['data'] = $this->session_data;
        return true;
    }

    public function get_fields($fields) {
        $return = null;
        if(is_array($fields)) {
            $return  = array();
            foreach($fields as $field) {
                $name = $this->prefix . $field;
                if(isset($this->session_data[$name])) {
                    $return[$field] = $this->session_data[$name];
                } else $return[$field] = null;
            }
        } else if(!empty($fields)) {
            $name = $this->prefix . $fields;
            if(isset($this->session_data[$name])) $return = $this->session_data[$name];
        }
    
        return $return;
    }

    public function unset_fields($fields = array()) {
        foreach($fields as $field)
            $this->unset_field($field);

        return true;
    }

    public function unset_field($field = null) {
        $name = $this->prefix . $field;
        if(isset($this->session_data[$name])) {
            unset($this->session_data[$name]);

            $_SESSION['data'] = $this->session_data;
            return true;
        }

        return false;
    }

    public function destroy_session() {
        session_unset();
        session_destroy();

        return true;
    }
}