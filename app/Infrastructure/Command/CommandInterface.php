<?php

namespace App\Infrastructure\Command;

interface CommandInterface
{

    public function execute(array $params);
}