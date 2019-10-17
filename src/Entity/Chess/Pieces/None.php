<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Entity\Chess\Pieces;

use App\Entity\Chess\ChessBoard;
use App\Entity\Chess\Pieces\Piece as Piece;
/**
 * Description of None
 *
 * @author yoan
 */
class None extends Piece
{
    public function __construct($x, $y, $color, $alive) 
    {
        $this->pos_x = $y;
        $this->pos_y = $x;
        $this->color = $color;
        $this->alive = $alive;
        $this->type = "-";
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

    public function eat ()
    {
        
    }
    
    public function display()
    {
              echo "--";
    }

    public function check(int $from, int $to, ChessBoard $chess, $player = null) {
        
    }

    public function move(int $fromx, int $fromy, int $tox, int $toy, ChessBoard $chess): array
    {
        $tab = array (0);
        $board = $chess->board;
        $board[$toy][$tox] = $chess->board[$fromy][$fromx];
        $board[$fromy][$fromx] = new None($fromx, $fromy, "", false);
        
        $tab[0]=$tox;
        $tab[1]=$toy;
        $tab[2]=$board[$toy][$tox]->type;
        $tab[3]=$board[$toy][$tox]->color;
        
        
        $chess->board = $board;

        $response = [
            'tab' => $tab,
            'chess' => $chess
        ];

        return $response;
    }
}