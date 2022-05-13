<?php

namespace App\Infrastructure\Command;

use App\Infrastructure\Command\CommandInterface;
use App\Application\Event\RestaurantEvent;

class RestaurantCommand implements CommandInterface
{
    private RestaurantEvent $event;

    public function __construct()
    {
        $this->event = new RestaurantEvent();
    }

    public function execute(array $params)
    {
        return $this->event->handle();
    }
}