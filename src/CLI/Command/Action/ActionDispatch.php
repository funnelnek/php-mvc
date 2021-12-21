<?php

namespace Funnelnek\CLI\Command\Action;

use Attribute;

enum ActionDispatch: string
{
    case NONE    = "none";
    case ERROR   = "error";
    case COMMAND = "command";
    case ACTION  = "action";
    case OPTION  = "option";
    case FLAG    = "flag";
}
