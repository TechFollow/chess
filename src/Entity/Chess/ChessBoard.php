<?php
/**
 * Description of ChessBoard
 *
 * @author durand_y
 */

namespace App\Entity\Chess;

use App\Entity\Chess\Pieces\Bishop;
use App\Entity\Chess\Pieces\King;
use App\Entity\Chess\Pieces\Queen;
use App\Entity\Chess\Pieces\None;
use App\Entity\Chess\Pieces\Tower;
use App\Entity\Chess\Pieces\Knight;
use App\Entity\Chess\Pieces\Pawn;

error_reporting (E_ALL);
//#TODO: side effect
ini_set ("display_errors", 1);
class ChessBoard
{
    private $instance;
    private $board;
    private $length = 8;
    private $height = 8;
    private $correspondance;

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
         $this->correspondance["a"] = 0;
         $this->correspondance["b"] = 1;
         $this->correspondance["c"] = 2;
         $this->correspondance["d"] = 3;
         $this->correspondance["e"] = 4; 
         $this->correspondance["f"] = 5;
         $this->correspondance["g"] = 6;
         $this->correspondance["h"] = 7;
            
        for ($i = 0; $i < $this->height; $i++) {
            for ($j = 0; $j < $this->length; $j++) {
                switch ($i) {
                    case 0:
                        switch ($j) {
                            case 0:
                                $this->board[$i][$j] = new Tower($i, $j, "White", true);
                                break;
                            case 1:
                                $this->board[$i][$j] = new Knight($i, $j, "White", true);
                                break;
                            case 2:
                                $this->board[$i][$j] = new Bishop($i, $j, "White", true);
                                break;
                            case 3:
                                $this->board[$i][$j] = new Queen($i, $j, "White", true);
                                break;
                            case 4:
                                $this->board[$i][$j] = new King($i, $j, "White", true);
                                break;
                            case 5:
                                $this->board[$i][$j] = new Bishop($i, $j, "White", true);
                                break;
                            case 6:
                                $this->board[$i][$j] = new Knight($i, $j, "White", true);
                                break;
                            case 7:
                                $this->board[$i][$j] = new Tower($i, $j, "White", true);
                                break;
                        }
                        break;
                    case 1:
                        $this->board[$i][$j] = new Pawn ($i, $j, "White", true);
                        break;
                    case 6:
                        $this->board[$i][$j] = new Pawn($i, $j, "Black", true);
                        break;
                    case 7:
                        switch ($j) {
                            case 0:
                                $this->board[$i][$j] = new Tower($i, $j, "Black", true);
                                break;
                            case 1:
                                $this->board[$i][$j] = new Knight($i, $j, "Black", true);
                                break;
                            case 2:
                                $this->board[$i][$j] = new Bishop($i, $j, "Black", true);
                                break;
                            case 3:
                                $this->board[$i][$j] = new Queen($i, $j, "Black", true);
                                break;
                            case 4:
                                $this->board[$i][$j] = new King($i, $j, "Black", true);
                                break;
                            case 5:
                                $this->board[$i][$j] = new Bishop($i, $j, "Black", true);
                                break;
                            case 6:
                                $this->board[$i][$j] = new Knight($i, $j, "Black", true);
                                break;
                            case 7:
                                $this->board[$i][$j] = new Tower($i, $j, "Black", true);
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
        if ($this->board[$this->correspondance[$from[0]]][$from[1]] != "-") {
            if ($this->board[$this->correspondance[$from[0]]][$from[1]]->check ($to) == true) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    
    
    public function display()
    {
        for ($i = 0; $i < $this->height; $i++) {
            echo "|" ;
            for ($j = 0; $j < $this->length; $j++) {
                echo $this->board[$i][$j]->display()."|";
            }
            echo "<br/>";
        }
    }

    public static function getInstance ()
    {
        if (isset (self::$instance)) {
            return (self::$instance);
        }
        return new ChessBoard ();
    }
}