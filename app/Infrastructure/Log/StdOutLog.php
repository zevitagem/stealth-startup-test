<?php

namespace App\Infrastructure\Log;

class StdOutLog
{

    public static function print($value)
    {
        print_r($value).'\n';
    }
}