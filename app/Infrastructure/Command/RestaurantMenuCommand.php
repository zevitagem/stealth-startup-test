<?php

namespace App\Infrastructure\Command;

use App\Infrastructure\Command\CommandInterface;
use App\Application\Event\RestaurantMenuEvent;

class RestaurantMenuCommand implements CommandInterface
{
    private RestaurantMenuEvent $event;

    public function __construct()
    {
        $this->event = new RestaurantMenuEvent();
    }

    public function execute(array $params)
    {
        $list = [];
        if (isset($params[1])) {
            $list = explode(',', $params[1]);
        }

        if (empty($list)) {
            throw new \InvalidArgumentException('Pelo menos 1 restaurante deve ser enviado');
        }

        $this->event->multipleHandle($list);
    }
}