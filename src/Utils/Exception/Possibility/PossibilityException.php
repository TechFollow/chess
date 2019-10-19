<?php


namespace App\Utils\Exception\Possibility;

use App\Utils\Exception\AbstractException;
use Throwable;

class PossibilityException extends AbstractException
{
    private $responseContent = array();

    final public function __construct(
        $responseContent,
        $level,
        $message = "",
        $code = 0,
        Throwable $previous = null
    )
    {
        $this->responseContent = $responseContent;
        parent::__construct($level, $message, $code, $previous);
    }

    public function getResponseContent(): array
    {
        return $this->responseContent;
    }
}