<?php

namespace App\Infrastructure\Command;

use App\Infrastructure\Command\CommandHandlerInterface;
use App\Infrastructure\Command\CommandInterface;

class LineCommandHandler implements CommandHandlerInterface
{
    private array $params = [];
    private ContainerCommands $commands;

    public function __construct(array $args)
    {
        $params = [];

        if (count($args) > 1) {
            $params = $this->extractParams($args);
        }

        $this->setParams($params);
        $this->commands = new ContainerCommands();
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function addCommand(CommandInterface $command)
    {
        $this->commands->append($command);
        return $this;
    }

    private function setParams(array $params)
    {
        $this->params = $params;
    }

    private function extractParams(array $args)
    {
        array_shift($args);

        return $args;
    }

    private function hasParams()
    {
        return !empty($this->params);
    }

    private function getAction()
    {
        return $this->params[0];
    }

    private function getCommand(string $action)
    {
        $index = 'App\\Infrastructure\\Command\\'.$action.'Command';

        if ($this->commands->offsetExists($index)) {
            return $this->commands->offsetGet($index);
        }

        return null;
    }

    public function execute()
    {
        if (!$this->hasParams()) {
            throw new \InvalidArgumentException('Ação do comando não foi enviada');
        }

        $action  = $this->getAction();
        $command = $this->getCommand($action);

        if ($command === null) {
            throw new \InvalidArgumentException('Classe do comando não foi encontrada');
        }

        return $command->execute($this->getParams());
    }
}