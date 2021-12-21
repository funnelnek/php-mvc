<?php

namespace Funnelnek\CLI\Console;

use Funnelnek\CLI\Command\Action\ActionDispatch;

enum ConsoleCommandConfiguration: string
{
    case ID          = "funnelnek";
    case TYPE        = "command";
    case SIGNATURE   = "{action?} {option*|argument*|flag}";
    case SHORTCODE   = "flk";
    case CONTROLLER  = Console::class;
    case DESCRIPTION = "The Funnelnek Console Application (TFCA)";
}
