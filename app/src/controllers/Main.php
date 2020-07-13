<?php namespace XyLex\Controllers;

use \XyLex\Services;

class Main extends Controller {
    public function __construct() {
        parent::__construct();
        $this->cache = Services::Cache();
    }

    public function index() {
        \XyLex\View::Render('main');
    }

    public function test() {
        printArray($this);
        $data = $this->cache->get('username');
        if($data)
            echo $data;
        
        else {
            $this->cache->set('username', 'demonicious', 86400);
            echo 'Created Cache.';
        }
    }
}