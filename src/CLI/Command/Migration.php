<?php

namespace Funnelnek\CLI\Command;

use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Exception\NoCommandFoundException;
use Funnelnek\CLI\Command\Migration\MigrationHelp;

class Migration extends Command
{

    protected const HELP = MigrationHelp::class;

    public function __construct(protected array $args)
    {
        array_shift($args);

        $command = $this->command = $args[0] ?? null;

        if (is_null($command)) {
            throw new NoCommandFoundException();
        }
    }

    public function execute(): void
    {
        $command = $this->command;

        if ($this->isHelp($command)) {
            echo $this->help();
            die();
        }
    }
}
