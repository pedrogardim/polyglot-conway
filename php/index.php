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
            foreach ($this->game_board[$row] as $col => $_) {
                $this->game_board[$row][$col] = rand(0, 1);
            }
        }
    }

    public function draw()
    {
        //clear screen
        system("clear");
        $frame = "";
        foreach ($this->game_board as $row => $_) {
            foreach ($this->game_board[$row] as $col => $_) {
                $frame .= $this->game_board[$row][$col] ? json_decode('"\u2588"') : ' ';
            }
            $frame .= PHP_EOL;
        }
        echo $frame;
    }
}

$gameOfLife = new GameOfLife();
