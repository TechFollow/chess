<?php


namespace App\Service\Chess\Updater;

use App\Utils\AbstractEnum;

class ResponseStatus extends AbstractEnum
{
    const SUCCESS = 200;
    const FAILURE = 400;
}