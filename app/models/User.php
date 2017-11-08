<?php

class User implements UserInterface {

	private $db;

	function __construct(Database $db){
		$this->db = $db;
	}

	// Get user by username
	public function getUserByUsername(string $username) {
		return $this->db->select("SELECT * FROM users WHERE username = :username", 
			["username" => $username]
		);
	}	

	// Add user
	public function addUser(
		string $username, string $password, 
		string $first_name, string $last_name, string $birthdate, 
		string $mobile_no, string $phone_no, string $email, 
		string $company, string $branch) {

		return $this->db->insert("
			INSERT INTO users (username, password, first_name, last_name, birthdate, mobile_no, phone_no, email, company, branch) 
			VALUES (:username, :password, :first_name, :last_name, :birthdate, :mobile_no, :phone_no, :email, :company, :branch)", 

			["username" => $username,
			"password" => password_hash($password, PASSWORD_DEFAULT),
			"first_name" => $first_name,
			"last_name" => $last_name,
			"birthdate" => $birthdate,
			"mobile_no" => $mobile_no,
			"phone_no" => $phone_no,
			"email" => $email,
			"company" => $company,
			"branch" => $branch
		]);
	}

	// Get all users
	public function getAllUsers() : array {
		return $this->db->select("SELECT id, username FROM users");
	}

	// Remove user by ID
	public function removeUser(int $id) : bool {
		return $this->db->remove("DELETE FROM users WHERE id = :id",
			["id" => $id]);
	}

}