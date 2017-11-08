<?php

class Register extends Controller {

	public function index() {

		$data['title'] = "Registration";
		$data['guest'] = true;
		$data['header'] = "CA Dice Game";
		$data['body'] = "This is the best game!";

		// $user = $this->model('User');
		// $data['users'] = $user->getUserByUsername($username);


		$this->view("register", $data);
	}

	public function test() {

		echo "Register / Test";
	}
}