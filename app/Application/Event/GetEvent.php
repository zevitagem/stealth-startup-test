<?php

namespace App\Application\Event;

use App\Infrastructure\Repository\MenuProcessorRepository;
use App\Application\Event\Event;
use App\Application\Event\AbstractEvent;

class GetEvent extends AbstractEvent implements Event
{
    private MenuProcessorRepository $repository;

    public function __construct()
    {
        $this->repository = new MenuProcessorRepository($this);
    }

    public function handle(array $params = [])
    {
        return $this->repository->addShowItems()->execute();
    }
}