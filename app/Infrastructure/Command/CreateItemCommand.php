<?php

namespace App\Infrastructure\Command;

use App\Infrastructure\Command\CommandInterface;
use App\Application\Event\CreateItemEvent;

class CreateItemCommand implements CommandInterface
{
    private CreateItemEvent $event;

    public function __construct()
    {
        $this->event = new CreateItemEvent();
    }

    public function execute(array $params)
    {
        $this->event->handle();
    }
}