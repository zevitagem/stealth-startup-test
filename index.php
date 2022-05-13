<?php
include_once 'vendor/autoload.php';

use App\Infrastructure\Command\LineCommandHandler;
use App\Infrastructure\Command\{
    GetCommand,
    RestaurantCommand,
    RestaurantMenuCommand,
    CreateItemCommand
};

$handler = new LineCommandHandler($argv);

$handler
    ->addCommand(new GetCommand())
    ->addCommand(new RestaurantCommand())
    ->addCommand(new RestaurantMenuCommand())
    ->addCommand(new CreateItemCommand());

$handler->execute();

