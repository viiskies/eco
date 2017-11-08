<?php

interface GameInterface {

    public function getAllGames() : array;
    public function getUserGames(int $int) : array;
    public function getTopWinners(int $count) : array;
    public function getTopPlayers(int $count) : array;

}