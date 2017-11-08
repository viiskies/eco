<?php

class Home extends Controller {

    public function index() {

        $data['title'] = "CA Dice Game";
        $data['header'] = "CA Dice Game";
        $data['body'] = "This is the best game!";

        $this->view("main", $data);
    }

    public function userList() {

        $user = $this->model('User');
        $game = $this->model('Game');

        $data['games'] = $game->getAllGames();
        $data['users'] = $user->getAllUsers();

        $data['title'] = "CA Dice Game";
        $data['header'] = "User List";
        $data['body'] = "Here we have a list of our players";

        $this->view("main", $data);
    }
}