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
        $this->game_board = array_fill(0, $height, array_fill(0, $width, 0));
        $this->randomize();
        $this->draw();
        while (true) {
            usleep(200 * 1000);
            $this->game_cycle();
            $this->draw();
        }
    }

    public function randomize()
    {
        foreach ($this->game_board as $row => $_) {
            foreach ($this->game_board[$row] as $col => $_) {
                $this->game_board[$row][$col] = rand(0, 1);
            }
        }
    }

    public function game_cycle()
    {
        $new_game = $this->game_board;
        foreach ($this->game_board as $row => $_) {
            foreach ($this->game_board[$row] as $col => $_) {
                $neighbours = array(
                    @$this->game_board[$row + 1][$col - 1],
                    @$this->game_board[$row + 1][$col],
                    @$this->game_board[$row + 1][$col + 1],
                    @$this->game_board[$row - 1][$col - 1],
                    @$this->game_board[$row - 1][$col],
                    @$this->game_board[$row - 1][$col + 1],
                    @$this->game_board[$row][$col - 1],
                    @$this->game_board[$row][$col + 1],
                );

                $living_neighbours = count(array_filter($neighbours));

                $should_live = $this->game_board[$row][$col];

                if ($living_neighbours < 2 || $living_neighbours > 3) {
                    $should_live = false;
                }
                if ($living_neighbours == 3) {
                    $should_live = true;
                }
                $new_game[$row][$col] = $should_live;
            }
        }
        $this->game_board = $new_game;
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
