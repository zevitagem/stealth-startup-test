<?php

namespace App\Application\Event;

interface Event
{

//    public function onStart();
//
//    public function onEnd($response);
//
//    public function onEndWait($response);

    public function handle(array $params = []);
}