<?php

interface UserInterface {

    public function getUserByUsername(string $username);
    public function addUser(string $username, string $password, 
		string $first_name, string $last_name, string $birthdate, 
		string $mobile_no, string $phone_no, string $email, 
		string $company, string $branch);

}