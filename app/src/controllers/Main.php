<?php namespace XyLex\Controllers;

use \XyLex\View;

class Main {
    public function index($params) {
        View::Render('main', array(
            'title' => 'Welcome to ' . NAME . ' - ' . VERSION
        ));
    }
}