<?php

namespace App\Application\Event;

use App\Infrastructure\Repository\MenuProcessorRepository;
use App\Application\Event\Event;
use App\Application\Event\AbstractEvent;

class RestaurantMenuEvent extends AbstractEvent implements Event
{
    private MenuProcessorRepository $repository;

    public function __construct()
    {
        $this->repository = new MenuProcessorRepository($this);

    }

    public function multipleHandle(array $params = [])
    {
        if (empty($params)) {
            return;
        }

        foreach ($params as $restaurant) {
            $this->repository->addGetRestaurantMenuByCode($restaurant);
        }

        $this->repository->execute();
    }
}