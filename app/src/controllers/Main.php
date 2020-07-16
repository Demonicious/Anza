<?php namespace Anza\Controllers;

class Main extends Controller {    
    public function index($params) {
        \Anza\View::Render('main');
    }
}