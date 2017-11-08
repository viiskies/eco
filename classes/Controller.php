<?php


class Controller {

    protected $db;

    function __construct(Database $db){
        $this->db = $db;
    }

    protected function model(string $model) {
        require_once "app/models/" . $model . ".php";
        return new $model($this->db);
    }


    protected function view(string $view, array $data) {
        require_once "app/views/" . $view . ".php";
    }
}