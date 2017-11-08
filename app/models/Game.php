<?php

class Game implements GameInterface {

    private $db;

    function __construct(Database $db){
        $this->db = $db;
    }

    public function getAllGames(): array
    {
         return $this->db->select("SELECT * FROM games");
    }

    public function getUserGames(int $int): array
    {
       
    }

    public function getTopWinners(int $count): array
    {
        // TODO: Implement getTopWinners() method.
    }

    public function getTopPlayers(int $count): array
    {
        // TODO: Implement getTopPlayers() method.
    }
}