<?php


namespace App\Controller;

use App\Service\Chess\Updater\ChessGameUpdater;
use App\Service\Chess\Updater\MovePossibility;
use App\Service\Chess\Updater\ResponseBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChessController extends AbstractController
{
    function enabledMoves(Request $request): Response
    {
        $chessGameUpdater = new ChessGameUpdater(new ResponseBuilder(), new MovePossibility());

        $chessGameUpdater->buildMovePossibility($request, $this->get('session'));

        return $chessGameUpdater->getEncodedResponse();
    }

    function move(Request $request): Response
    {
        $chessGameUpdater = new ChessGameUpdater(new ResponseBuilder(), new MovePossibility());

        $chessGameUpdater->requestForMove($request, $this->get('session'));

        return $chessGameUpdater->getEncodedResponse();
    }
}