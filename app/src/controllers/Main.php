<?php namespace XyLex\Controllers;

use \XyLex\Services;

class Main extends Controller {
    public function index() {
        $cache = Services::Cache();
        \XyLex\View::Render('main');
    }
}