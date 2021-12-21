<?php

namespace Funnelnek\CLI;

class Payload
{
    public readonly string $file;
    public readonly string $query;
    public readonly array  $flags;
    public readonly array  $options;
    public readonly array  $parameters;

    public function __construct(array $argv)
    {
        $this->file       = $argv['file'];
        $this->query      = $argv["cli"];
        $this->flags      = $argv["flags"];
        $this->options    = $argv["options"];
        $this->parameters = $argv["parameters"];
    }
}
