<?php

namespace App\Entity\Chess\Pieces;

use App\Entity\Chess\ChessBoard;

abstract class Piece
{
    protected $color;
    protected $pos_x;
    protected $pos_y;
    protected $alive;
    protected $type;

    /*
     * Color move change the color of the board when a piece is selected
     * eat take a piece from the opponent
     */
    abstract public function move (int $fromx, int $fromy, int $tox, int $toy, ChessBoard $chess);
    abstract public function check (int $from,int $to, ChessBoard $chess, $player = null);
    abstract public function eat ();
    
    //display the piece
    
    abstract public function display ();
}
