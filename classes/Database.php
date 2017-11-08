<?php

class Database {

    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "ecoservice";

    private $connection;

    function __construct(){
        try {
            $this->connection = new PDO("mysql:host=". $this->hostname. ";dbname=" . $this->database . ";charset=utf8", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    // Select
    public function select(string $sql, array $param = []) : array {
        // example SELECT * FROM users WHERE id = :id
        $statement = $this->connection->prepare($sql);
        // example $param = ["id" => 666];
        $statement->execute($param);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insert
    public function insert(string $sql, array $param = []) : int {
        $statement = $this->connection->prepare($sql);
        $statement->execute($param);
        return $this->connection->lastInsertId();
    }

    // Remove
    public function remove(string $sql, array $param = []) : bool {
        $statement = $this->connection->prepare($sql);
        $statement->execute($param);
        return $statement->rowCount();
    }

    function __destruct() { $this->connection = null; }

}