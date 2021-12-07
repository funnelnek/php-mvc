<?php

namespace Funnelnek\Core\Service;

enum ServiceStrategy: int
{
    case SCOPED = 1;
    case SINGLETON = 2;
    case TRANSIENT = 3;
    case INSTANCE = 4;
}
