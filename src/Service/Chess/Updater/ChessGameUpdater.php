<?php


namespace App\Service\Chess\Updater;

use App\Utils\Exception\ExceptionLevel;
use App\Utils\Exception\Possibility\PossibilityException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class ChessGameUpdater
{
    protected $movePossibility;
    protected $responseBuilder;

    public function __construct(ResponseBuilder $responseBuilder,
                                MovePossibility $movePossibility)
    {
        $this->responseBuilder = $responseBuilder;
        $this->movePossibility = $movePossibility;
    }

    private function buildResponseByPossibility(): void
    {
        if (!$this->movePossibility->isMovePossible()) {
            $this->responseBuilder->setContent(array());
        } else {
            $this->responseBuilder->setContent(
                $this->movePossibility->getPossibility()
            );
        }
     }

    public function buildMovePossibility(Request $request, Session $session): void
    {
        $player = $session->get('player');
        $chessBoard = $session->get('chessboard');

        try {
            $this->movePossibility->setPossibility($request, $chessBoard, $player);
            self::buildResponseByPossibility();
        } catch (PossibilityException $e) {
            if ($e->getExceptionLevel() == ExceptionLevel::MINOR) {
                $this->responseBuilder->setContent($e->getResponseContent());
            } else {
                $this->responseBuilder->setStatus($e->getCode());
            }
        }

        $this->updateSession(
            $session,
            $this->movePossibility->getPossibility(),
            $session->get('player'),
            $request->get('mx'),
            $request->get('my')
        );
    }

    public function getEncodedResponse(): Response
    {
        return $this->responseBuilder->createResponse();
    }

    function requestForMove(Request $request, Session $session): void
    {
        $position = self::move($request, $session);

        $this->responseBuilder->setContent($position);
    }

    private function move(Request $request, Session $session): array
    {
        $x = $request->get('mx');
        $y = $request->get('my');
        $player = $session->get('player');
        $test = $session->get('chessboard');
        $tab = array();

        if (($player % 2 == 0)) {
            if ($test->board[$y][$x]->type != "-") {
                $tab = $test->board[$y][$x]->check($x, $y, $test, $player);
            } elseif ($test->board[$y][$x]->type == "-" ||
                $test->board[$y][$x]->color == "Black") {
                for ($i = 0; $i < sizeof($session->get('ancient')); $i++) {
                    if ($i % 2 == 0) {
                        if ($session->get('ancient')[$i] == $x) {
                            if ($session->get('ancient')[$i + 1] == $y) {
                                $moveResponse = $test->board[$y][$x]
                                    ->move(
                                        $session->get('ax'),
                                        $session->get('ay'),
                                        $x,
                                        $y,
                                        $test
                                    );
                                $session
                                    ->set('chessBoard', $moveResponse['chess']);
                                $tab = $moveResponse['tab'];
                                $player ^= 1;
                                break;
                            }
                        }
                    }

                }
            }
        } elseif (($player % 2 == 1)) {
            if ($test->board[$y][$x]->type != "-") {
                $tab = $test->board[$y][$x]->check($x, $y, $test, $player);
            } elseif ($test->board[$y][$x]->type == "-" ||
                $test->board[$y][$x]->color == "White") {
                for ($i = 0; $i < sizeof($session->get('ancient')); $i++) {
                    if ($i % 2 == 0) {
                        if ($session->get('ancient')[$i] == $x) {
                            if ($session->get('ancient')[$i + 1] == $y) {
                                $moveResponse = $test->board[$y][$x]
                                    ->move(
                                        $session->get('ax'),
                                        $session->get('ay'),
                                        $x,
                                        $y,
                                        $test
                                    );
                                $session->set(
                                    'chessBoard',
                                    $moveResponse['chess']
                                );
                                $tab = $moveResponse['tab'];
                                $player ^= 1;
                                break;
                            }
                        }
                    }

                }
            }
        }

        $this->updateSession($session, $tab, $player, $x, $y);

        return ($tab);
    }

    public function updateSession(
        Session $session,
        array $board,
        int $player,
        int $x,
        int $y
    ): void
    {
        $session->set('player', $player);
        $session->set('ancient', $board);
        $session->set('ax', $x);
        $session->set('ay', $y);
    }
}