<?php

namespace App\Entity\Chess;

use App\Entity\Chess\Pieces\Bishop;
use App\Entity\Chess\Pieces\King;
use App\Entity\Chess\Pieces\Queen;
use App\Entity\Chess\Pieces\None;
use App\Entity\Chess\Pieces\Tower;
use App\Entity\Chess\Pieces\Knight;
use App\Entity\Chess\Pieces\Pawn;

/*
error_reporting (E_ALL);
    #TODO: side effect, why display error setting
ini_set ("display_errors", 1);
*/

class ChessBoard
{
    private $instance;
    private $board;
    private $length = 8;
    private $height = 8;
    private $correspondence;

    //getter setter
    public function __get($name)
    {
       return $this->$name;
    }
            
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    //constructor
    public function  __construct()
    {
        $this->correspondence["a"] = 0;
        $this->correspondence["b"] = 1;
        $this->correspondence["c"] = 2;
        $this->correspondence["d"] = 3;
        $this->correspondence["e"] = 4;
        $this->correspondence["f"] = 5;
        $this->correspondence["g"] = 6;
        $this->correspondence["h"] = 7;

        for ($i = 0; $i < $this->height; $i++) {
            for ($j = 0; $j < $this->length; $j++) {
                switch ($i) {
                    case 0:
                        switch ($j) {
                            case 0:
                                $this->board[$i][$j] = new Tower(
                                                            $i,
                                                            $j,
                                                            "White",
                                                            true
                                                        );
                                break;
                            case 1:
                                $this->board[$i][$j] = new Knight(
                                                            $i,
                                                            $j,
                                                            "White",
                                                            true
                                                        );
                                break;
                            case 2:
                                $this->board[$i][$j] = new Bishop(
                                                            $i,
                                                            $j,
                                                            "White",
                                                            true
                                                        );
                                break;
                            case 3:
                                $this->board[$i][$j] = new Queen(
                                                            $i,
                                                            $j,
                                                            "White",
                                                            true
                                                        );
                                break;
                            case 4:
                                $this->board[$i][$j] = new King(
                                                            $i,
                                                            $j,
                                                            "White",
                                                            true
                                                        );
                                break;
                            case 5:
                                $this->board[$i][$j] = new Bishop(
                                                            $i,
                                                            $j,
                                                            "White",
                                                            true
                                                        );
                                break;
                            case 6:
                                $this->board[$i][$j] = new Knight(
                                                            $i,
                                                            $j,
                                                            "White",
                                                            true
                                                        );
                                break;
                            case 7:
                                $this->board[$i][$j] = new Tower(
                                                            $i,
                                                            $j,
                                                            "White",
                                                            true
                                                        );
                                break;
                            default:
                                break;
                        }
                    break;
                    case 1:
                        $this->board[$i][$j] = new Pawn (
                                                    $i,
                                                    $j,
                                                    "White",
                                                    true
                                                );
                        break;
                    case 6:
                        $this->board[$i][$j] = new Pawn(
                                                    $i,
                                                    $j,
                                                    "Black",
                                                    true
                                                );
                        break;
                    case 7:
                        switch ($j) {
                            case 0:
                                $this->board[$i][$j] = new Tower(
                                                            $i,
                                                            $j,
                                                            "Black",
                                                            true
                                                        );
                                break;
                            case 1:
                                $this->board[$i][$j] = new Knight(
                                                            $i,
                                                            $j,
                                                            "Black",
                                                            true
                                                        );
                                break;
                            case 2:
                                $this->board[$i][$j] = new Bishop(
                                                            $i,
                                                            $j,
                                                            "Black",
                                                            true
                                                        );
                                break;
                            case 3:
                                $this->board[$i][$j] = new Queen(
                                                            $i,
                                                            $j,
                                                            "Black",
                                                            true
                                                        );
                                break;
                            case 4:
                                $this->board[$i][$j] = new King(
                                                            $i,
                                                            $j,
                                                            "Black",
                                                            true
                                                        );
                                break;
                            case 5:
                                $this->board[$i][$j] = new Bishop(
                                                            $i,
                                                            $j,
                                                            "Black",
                                                            true
                                                        );
                                break;
                            case 6:
                                $this->board[$i][$j] = new Knight(
                                                            $i,
                                                            $j,
                                                            "Black",
                                                            true
                                                        );
                                break;
                            case 7:
                                $this->board[$i][$j] = new Tower(
                                                            $i,
                                                            $j,
                                                            "Black",
                                                            true
                                                        );
                                break;
                        }
                    break;
                    default :
                        $this->board[$i][$j] = new None($i, $j, "", false);
                        break;
                }
            }
        }
    }

    public function isValid ($from, $to)
    {
        if ($this->board[$this->correspondence[$from[0]]][$from[1]] != "-") {
            if ($this->board[$this->correspondence[$from[0]]][$from[1]]
                     ->check ($to) == true) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

}