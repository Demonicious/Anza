<?php namespace XyLex\Controllers;

class Main extends Controller {
    public function index($params) {
        \XyLex\View::Render('main');
    }
}