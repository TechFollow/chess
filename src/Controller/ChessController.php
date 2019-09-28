<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ChessController extends AbstractController
{
    function updateGame(Request $request): Response
    {
        $x = $request->get('mx');
        $y = $request->get('my');
        $player = $this->get('session')->get('player');
        $test = $this->get('session')->get('chessboard');
        $tab = array(0);

        if (($player % 2 == 0))
        {
            if ($test->board[$y][$x]->type != "-")
            {
                $tab = $test->board[$y][$x]->check($x, $y, $test, $player);
            }
            elseif ($test->board[$y][$x]->type == "-" || $test->board[$y][$x]->color == "Black")
            {
                for ($i = 0; $i < sizeof($this->get('session')->get('ancient')); $i++)
                {
                    if ($i % 2 == 0)
                    {
                        if ($this->get('session')->get('ancient')[$i] == $x)
                        {
                            if ($this->get('session')->get('ancient')[$i + 1] == $y)
                            {
                                $moveResponse = $test->board[$y][$x]->move($this->get('session')->get('ax'), $this->get('session')->get('ay'), $x, $y, $test);
                                $this->get('session')->set('chessBoard', $moveResponse['chess']);
                                $tab = $moveResponse['tab'];
                                $player++;
                                break;
                            }
                        }
                    }

                }
            }
        }
        elseif (($player % 2 == 1))
        {
            if ($test->board[$y][$x]->type != "-")
            {
                $tab = $test->board[$y][$x]->check($x, $y, $test, $player);
            }
            elseif ($test->board[$y][$x]->type == "-" || $test->board[$y][$x]->color == "White")
            {
                for ($i = 0; $i < sizeof($this->get('session')->get('ancient')); $i++)
                {
                    if ($i % 2 == 0)
                    {
                        if ($this->get('session')->get('ancient')[$i] == $x)
                        {
                            if ($this->get('session')->get('ancient')[$i + 1] == $y)
                            {
                                $moveResponse = $test->board[$y][$x]->move($this->get('session')->get('ax'), $this->get('session')->get('ay'), $x, $y, $test);
                                $this->get('session')->set('chessBoard', $moveResponse['chess']);
                                $tab = $moveResponse['tab'];
                                $player++;
                                break;
                            }
                        }
                    }

                }
            }
        }

        $this->get('session')->set('player', $player);
        $this->get('session')->set('ancient', $tab);
        $this->get('session')->set('ax', $x);
        $this->get('session')->set('ay', $y);

        $my_encode_array = json_encode($tab);

        return new Response($my_encode_array, 200, array('Content-type', 'json'));
    }
}