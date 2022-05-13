<?php

namespace App\Infrastructure\Log;

class FileLog
{

    public static function write(string $text, array $args = [])
    {
        $file    = __DIR__.'/../../../storage/log';
        $content = vsprintf($text, $args).PHP_EOL;

        file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
    }
}