<?php


namespace App\Controller;

use App\Service\Chess\Updater\ChessGameUpdater;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChessController extends AbstractController
{
    function enabledMoves(Request $request, ChessGameUpdater $chessGameUpdater): Response
    {
        $chessGameUpdater->buildMovePossibility($request, $this->get('session'));

        return $chessGameUpdater->getEncodedResponse();
    }

    function move(Request $request, ChessGameUpdater $chessGameUpdater): Response
    {
        $chessGameUpdater->requestForMove($request, $this->get('session'));

        return $chessGameUpdater->getEncodedResponse();
    }
}