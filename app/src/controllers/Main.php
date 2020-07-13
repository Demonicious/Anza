<?php namespace XyLex\Controllers;

class Main extends Controller {
    public function index() {
        \XyLex\View::Render('main');
    }
}