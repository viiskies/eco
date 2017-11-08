<?php

class Login extends Controller {

	public function index() {

		echo "Login / Index";
	}

	public function test() {

		echo "Login / Test";
	}

	public function register() {

		$data['title'] = "CA Dice Game";
		$data['header'] = "CA Dice Game";
		$data['body'] = "This is the best game!";

		$this->view("main", $data);
	}
}