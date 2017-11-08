<?php

class App {

    protected $controller = "Home";
    protected $method = "index";
    protected $args = [];
    public $db;

    public function __construct() {

        // we are going to need a database object in this application
        $this->db = new Database;

        // parse the URL (explode on / char)
        $url = $this->parseUrl();

        // check for controller
        if(file_exists('app/controllers/' . $url[0] . '.php')){
            // set current controller
            $this->controller = $url[0];

            // remove it from url
            array_shift($url);
        }

        // lazy-load required controller
        require_once 'app/controllers/' . $this->controller . '.php';

        // instantiate this controller
        $this->controller = new $this->controller($this->db);

        // check for method
        if (isset($url[0])) {
            if (method_exists($this->controller, $url[0])) {
                // set current method
                $this->method = $url[0];
                array_shift($url);
            }
        }

        // check for arguments
        $this->args = $url ? $url : [];

        // Call actual controller and method with arguments
        call_user_func_array([$this->controller, $this->method,], $this->args);
    }

    protected function parseUrl() {
        if (isset($_GET['url'])) {
            // trim spaces and trailing /
            // filter var for URLs
            // explode URL on /
            return explode("/",filter_var(rtrim($_GET['url'], "/"), FILTER_SANITIZE_URL ));
        }
    }
}