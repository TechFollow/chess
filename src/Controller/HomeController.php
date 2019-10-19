<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Chess\ChessBoard;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('/index.html.twig', ['']);
    }

    public function play(): Response
    {
        $chessBoard = new ChessBoard();
        $player = 0;

        $this->get('session')->set('player', $player);
        $this->get('session')->set('chessboard', $chessBoard);
        $this->get('session')->set('ancient', array());

        return $this->render('/game/index.html.twig', []);
    }
}