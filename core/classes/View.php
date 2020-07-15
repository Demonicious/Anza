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

class View {
    private static function CorrectName($view_name) {
        $final = substr($view_name, -4);
        if($final !== '.php')
            $view_name .= '.php';

        return $view_name;
    }

    public static function Include($view_name, $core = false) {
        return self::Render($view_name, $GLOBALS['Anza-data'], $core);
    }

    public static function Render($view_name, $data = array(), $core = false) {
        $GLOBALS['Anza-data'] = $data;

        foreach($data as $variable => $value) {
            ${$variable} = $value;
        }

        $view_name = self::CorrectName($view_name);

        if(!$core) {
            require VIEWS . $view_name;
        } else {
            require CORE_PATH . 'views' . DIRECTORY_SEPARATOR . $view_name;
        }

        return true;
    }
}