<?php

namespace App\Infrastructure\Command;

class ContainerCommands extends \ArrayObject
{

    public function append(mixed $value): void
    {
        parent::offsetSet(get_class($value), $value);
    }
}