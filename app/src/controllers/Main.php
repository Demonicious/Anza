<?php namespace Anza\Controllers;

class Main extends Controller {
    public function index($params) {
        $cache = \Anza\Services::Cache();

        \Anza\View::Render('main');
    }
}