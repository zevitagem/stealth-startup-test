<?php

namespace App\Infrastructure\Repository;

use App\Application\Event\Event;
use App\Infrastructure\Utils\GuzzleUtil;

trait AsyncRepository
{
    private array $promisses = [];
    private Event $event;

    public function getEvent()
    {
        return $this->event;
    }

    public function getPromisses()
    {
        return $this->promisses;
    }

    private function addPromises($item)
    {
        $this->promisses[] = $item;
    }

    protected function extractResponse($response):array {
        return GuzzleUtil::extractResponse($response);
    }

    private function onEnd($response)
    {
        return $this->getEvent()->onEnd($this->extractResponse($response));
    }

    public function execute()
    {
        $this->getEvent()->onStart();

        $promises = $this->getPromisses();

        try {
            $results = \GuzzleHttp\Promise\unwrap($promises);
            $results = \GuzzleHttp\Promise\settle($promises)->wait();
            $this->getEvent()->onEndWait($results);
        } catch (\Throwable $exc) {
            $this->getEvent()->onException($exc);
        }
    }
}