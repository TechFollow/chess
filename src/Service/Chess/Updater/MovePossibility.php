<?php


namespace App\Service\Chess\Updater;

use App\Entity\Chess\ChessBoard;
use App\Utils\Exception\ExceptionLevel;
use App\Utils\Exception\Possibility\PossibilityException;
use Symfony\Component\HttpFoundation\Request;

class MovePossibility
{
    private $possibility = array();

    public function getPossibility(): array
    {
        return $this->possibility;
    }

    public function isMovePossible(): bool
    {
        if (empty($this->possibility)) {
            return false;
        }

        return true;
    }

    /**
     * @param Request $request
     * @param ChessBoard $chessBoard
     * @param int $player
     * @throws PossibilityException
     */
    public function setPossibility(Request $request,
                                   ChessBoard $chessBoard,
                                   int $player): void
    {
        $x = $request->get('mx');
        $y = $request->get('my');
        $board = $chessBoard->getBoard();

        if ($board[$y][$x]->type == "-") {
            throw new PossibilityException(
                array(ResponseStatus::FAILURE),
                ExceptionLevel::MINOR,
                "selection is not a valid piece",
                ResponseStatus::SUCCESS);
        }

        $this->possibility = $board[$y][$x]->check($x, $y, $chessBoard, $player);
    }
}