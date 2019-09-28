<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Chess\ChessBoard;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function index(): Response
    {
        return ($this->render('chess/home/index.php', ['']));
    }

    public function play(): Response
    {
        $chessBoard = new ChessBoard();
        $player = 0;

        $this->get('session')->set('player', $player);
        $this->get('session')->set('chessboard', $chessBoard);

        return ($this->render('chess/game/jeu.php', []));
    }
}