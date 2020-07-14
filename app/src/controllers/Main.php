<?php namespace XyLex\Controllers;

use \XyLex\Services;

class Main extends Controller {
    public function index($params) {
        \XyLex\View::Render('main');
    }
}