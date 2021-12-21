<?php

declare(strict_types=1);


namespace Funnelnek\CLI\Console\Action;

use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Attribute\Action;
use Funnelnek\CLI\Console\ConsoleCommand;


class Help extends Command
{
    public static function dispatch(#[Action(ConsoleCommand::HELP)] array $args): void
    {
    }
    public function __construct(mixed ...$args)
    {
    }
    public function execute(mixed ...$args): void
    {
    }
}
