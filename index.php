<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        //tic tac toe class
        class Game {

            //the 9 slots
            var $position;

            //assign slots
            function __construct($squares) {
                $this->position = str_split($squares);
            }

            //draws the 9 spots from url input
            function display() {
                echo '<table cols="3" style = "font-size: large; font-weight:bold">';
                echo '<tr>';
                for ($pos = 0; $pos < 9; $pos++) {
                    echo $this->show_cell($pos);
                    if ($pos % 3 == 2) {
                        echo '</tr><tr>';
                    }
                }
                echo '</tr>';
                echo '</table>';
            }

            //assign the next available spot to x
            function pick_move() {
                for($i = 0; $i < 9; $i++) {
                    if($this->position[$i] == '-') {
                        $this->position[$i] = 'x';
                        break;
                    }
                }
            }
            
            //draw the spot, if empty draw a link that assigns a new url
            function show_cell($which) {
                $token = $this->position[$which];
		if($token <> '-') {
			return '<td>'.$token.'</td>';
		}
		$this -> newposition = $this->position;
		$this -> newposition[$which] = 'o';
		$move = implode($this->newposition);
		$link = '/repo/index.php?board='.$move;
		return '<td><a href="'.$link.'">-</a></td>';
            }

            //check if any users have won
            function winner($token) {
                $result = false;
                for ($row = 0; $row < 3; $row++) {
                    $result = true;
                    for ($col = 0; $col < 3; $col++) {
                        if ($this->position[(3 * $row) + $col] != $token) {
                            $result = false;
                        }
                    }
                    if($result == true) {
                        return $result;
                    }
                }
                for ($column = 0; $column < 3; $column++) {
                    $result = true;
                    for ($row = 0; $row < 3; $row++) {
                        if ($this->position[$column + (3 * $row)] != $token) {
                            $result = false;
                        }
                    }
                    if($result == true) {
                        return $result;
                    }
                }
                if ($this->position[0] == $token && $this->position[4] == $token && $this->position[8] == $token) {
                    $result = true;
                } else if ($this->position[2] == $token && $this->position[4] == $token && $this->position[6] == $token) {
                    $result = true;
                }
                return $result;
            }

        }

        $squares = $_GET['board'];
        $game = new Game($squares);

        $game->pick_move(); 
        $game->display();
        
        if ($game->winner('x')) {
            echo 'You win, lucky guesses';
        } else if ($game->winner('o')) {
            echo 'I win, muhahahaahahah';
        } else {
            echo 'No winners yet, but you are losing';
        }
        
        ?>
    </body>
</html>