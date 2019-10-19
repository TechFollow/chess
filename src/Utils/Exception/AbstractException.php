<?php


namespace App\Utils\Exception;


use Symfony\Component\Config\Definition\Exception\Exception;
use Throwable;

abstract class AbstractException extends Exception
{
    private $level;

    public function __construct(
        $level,
        $message = "",
        $code = 0,
        Throwable $previous = null
    )
    {
        $this->level = $level;
        parent::__construct($message, $code, $previous);
    }

    public function getExceptionLevel(): int
    {
        return $this->level;
    }
}