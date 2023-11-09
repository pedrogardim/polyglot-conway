<?php
class GameOfLife
{
    public $game_board = [];

    public function __construct()
    {
        $this->init_game();
    }

    public function init_game()
    {
        $width = intval(exec('tput cols'));
        $height = intval(exec('tput lines'));
        $this->game_board = array_fill(0, $width, array_fill(0, $height, 0));
        $this->randomize();
        print_r($this->game_board);
    }

    public function randomize()
    {
        foreach ($this->game_board as $row => $_) {
            foreach ($this->game_board as $col => $_) {
                $this->game_board[$row][$col] = rand(0, 1);
            }
        }
    }
}

$gameOfLife = new GameOfLife();
