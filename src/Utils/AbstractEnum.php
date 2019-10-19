<?php


namespace App\Utils;


abstract class AbstractEnum {
    static function getKeys()
    {
        $class = new \ReflectionClass(get_called_class());
        return array_keys($class->getConstants());
    }
}