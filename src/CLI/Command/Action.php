<?php

namespace Funnelnek\CLI\Command;

use Funnelnek\CLI\ActionEvent;
use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Action\ActionDispatch;

class Action extends ActionEvent
{
    protected readonly ActionDispatch  $action;

    public readonly bool   $help;
    public readonly array  $flags;
    public readonly string $command;
    public readonly array  $options;
    public readonly array  $arguments;
    public readonly string $controller;

    public function __construct(array $payload)
    {
        $this->help       = isset($payload["help"]);
        $this->flags      = $payload["flags"];
        $this->action     = $payload["type"];
        $this->options    = $payload["options"];
        $this->arguments  = $payload["arguments"];
        $this->controller = $payload["controller"];

        if (isset($payload["command"])) {
            $this->command = $payload["command"];
        }

        if (isset($payload["action"])) {
            $this->command = $payload["action"];
        }
    }

    /**
     * Method type
     *
     * @return ActionDispatch
     */
    public function type(): ActionDispatch
    {
        return $this->action;
    }
}
