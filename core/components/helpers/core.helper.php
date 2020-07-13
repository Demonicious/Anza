<?php

if (!function_exists('getallheaders'))  {
    function getallheaders() {
        if (!is_array($_SERVER)) 
            return array();

        $headers = array();
        foreach ($_SERVER as $name => $value)
            if (substr($name, 0, 5) == 'HTTP_')
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        return $headers;
    }
}

function pretty_r($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function pretty_dump($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function esc_html($str) {
    return htmlentities($str);
} 

function decode_html($str) {
    return html_entity_decode($str);
}