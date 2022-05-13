<?php

namespace App\Application\Event;

use App\Infrastructure\Repository\MenuProcessorRepository;
use App\Application\Event\Event;
use App\Application\Event\AbstractEvent;

class CreateItemEvent extends AbstractEvent implements Event
{
    private MenuProcessorRepository $repository;

    public function __construct()
    {
        $this->repository = new MenuProcessorRepository($this);
    }

    public function handle(\Entity $response)
    {
        $body               = [
            'restaurant' => $params[1] ?? null,
            'rating' => $params[2] ?? null,
            'category' => $params[3] ?? null,
            'item_id' => $params[4] ?? null,
            'item_name' => $params[5] ?? null,
            'item_price' => $params[6] ?? null
        ];
        
//        $body['restaurant'] = 'Panda Noodles';
//        $body['rating']     = 4.4;
//        $body['category']   = "Value Set Meals";
//        $body['item_id']    = "2431937";
//        $body['item_name']  = "Green Vegetable 菜类";
//        $body['item_price'] = 10;

        return $this->repository->addCreateItem($response->toArray())->execute();
    }
}