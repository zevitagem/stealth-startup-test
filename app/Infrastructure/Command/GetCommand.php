<?php

namespace App\Infrastructure\Command;

use App\Infrastructure\Command\CommandInterface;
use App\Application\Event\GetEvent;

class GetCommand implements CommandInterface
{
    private GetEvent $event;

    public function __construct()
    {
        $this->event = new GetEvent();
    }

    public function execute(array $params)
    {
        return $this->event->handle();
    }
}