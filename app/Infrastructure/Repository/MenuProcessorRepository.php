<?php

namespace App\Infrastructure\Repository;

use GuzzleHttp\Client;
use App\Application\Event\Event;
use App\Infrastructure\Repository\AsyncRepository;

class MenuProcessorRepository
{
    const API  = 'http://menu-processor-api.fly.dev';
    const USER = 'joseph';

    use AsyncRepository;
    private $client;

    public function __construct(Event $event)
    {
        $this->client = new Client();
        $this->event  = $event;
    }

    public function getUrl()
    {
        //return getenv('env.sandbox');
        return self::API;
    }

    public function addShowItems()
    {
        $url = $this->getUrl().'/'.self::USER.'/items';

        $this->addPromises(
            $this->client->getAsync($url)->then(function ($response) {
                return $this->onEnd($response);
            })
        );

        return $this;
    }

    public function addShowRestaurants()
    {
        $url = $this->getUrl().'/restaurants';

        $this->addPromises(
            $this->client->getAsync($url)->then(function ($response) {
                return $this->onEnd($response);
            })
        );

        return $this;
    }

    public function addGetRestaurantMenuByCode(string $code)
    {
        $url = $this->getUrl().'/restaurants/'.$code;

        $this->addPromises(
            $this->client->getAsync($url)->then(function ($response) {
                return $this->onEnd($response);
            })
        );

        return $this;
    }

    public function addCreateItem(array $data)
    {
        $url = $this->getUrl().'/'.self::USER.'/items';
        print_r(['form_params' => $data]);
        $this->addPromises(
            $this->client->postAsync($url, ['form_params' => $data])->then(function ($response) {
                return $this->onEnd($response);
            })
        );

        return $this;
    }
}