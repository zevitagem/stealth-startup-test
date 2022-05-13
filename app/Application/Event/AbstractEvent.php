<?php

namespace App\Application\Event;

use App\Infrastructure\Log\StdOutLog;
use App\Infrastructure\Log\FileLog;

abstract class AbstractEvent
{

    public function onEnd($response)
    {
        StdOutLog::print($response);
        FileLog::write('[finalizei end]-> %s', [static::class]);

        //echo '[finalizei end] ...'.PHP_EOL;
    }

    public function onStart()
    {
        echo '[comecei] ...'.PHP_EOL;
    }

    public function onEndWait($response)
    {
        echo '[finalizei endWait] ...'.PHP_EOL;
    }

    public function handle(array $params = [])
    {
        // do anything
    }

    public function onException($exception)
    {
        echo '[onException] ...'.$exception->getMessage().PHP_EOL;
    }
}