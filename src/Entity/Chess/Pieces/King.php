<?php

namespace App\Entity\Chess\Pieces;

use App\Entity\Chess\ChessBoard;
use App\Entity\Chess\Pieces\Piece as Piece;

class King extends Piece
{
    private $hasMoved;
    
    public function __construct($x, $y, $color, $alive) 
    {
        $this->posX = $y;
        $this->posY = $x;
        $this->color = $color;
        $this->alive = $alive;   
        $this->type = "K";
        $this->hasMoved = false;
     }
    
     //getter setter
    
    public function __get($name) 
    {
        return $this->$name;
    }

    public function __set($name, $value) 
    {
        $this->$name = $value;
    }

    public function display()
    {
        if ($this->color == "White")
            echo "Kw";
        else 
            echo "Kb";
    }

    public function check(int $from, int $to, ChessBoard $chess, $player = null)
    {
        $cpt = 0;
        $px = $from;
        $py = $to;
        $tabres = array(0);
        
        if ($px + 1 < 8) {
            $tabres[$cpt] = $px + 1;
            $cpt++;
            $tabres[$cpt] = $py;
            $cpt++;
        }
        if ($px - 1 >= 0) {
            $tabres[$cpt] = $px - 1;
            $cpt++;
            $tabres[$cpt] = $py;
            $cpt++;
        }
        if ($py + 1 < 8) {
            $tabres[$cpt] = $px;
            $cpt++;
            $tabres[$cpt] = $py + 1;
            $cpt++;
        }
        if ($px - 1 >= 0) {
            $tabres[$cpt] = $px;
            $cpt++;
            $tabres[$cpt] = $py - 1;
            $cpt++;
        }
        if ($px + 1 < 8 && $py + 1 < 8) {
            $tabres[$cpt] = $px + 1;
            $cpt++;
            $tabres[$cpt] = $py + 1;
            $cpt++;
        }
        if ($px - 1 < 8 && $py + 1 < 8) {
            $tabres[$cpt] = $px - 1;
            $cpt++;
            $tabres[$cpt] = $py + 1;
            $cpt++;
        }
        if ($px - 1 < 8 && $py - 1 < 8) {
            $tabres[$cpt] = $px - 1;
            $cpt++;
            $tabres[$cpt] = $py - 1;
            $cpt++;
        }
        if ($px + 1 < 8 && $py - 1 < 8) {
            $tabres[$cpt] = $px + 1;
            $cpt++;
            $tabres[$cpt] = $py - 1;
            $cpt++;
        }

        return $tabres; 
    }

    public function move(
                        int $fromx,
                        int $fromy,
                        int $tox,
                        int $toy,
                        ChessBoard $chess
                    ): array
    {
        return [];
    }
}