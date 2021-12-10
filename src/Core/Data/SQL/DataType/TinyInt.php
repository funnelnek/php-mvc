<?php

namespace Funnelnek\Core\Data\SQL\DataType;

enum TinyInt: int
{
    case SIGNED_MIN = 0;
    case SIGNED_MAX = 255;
    case UNSIGNED_MIN = -127;
    case UNSIGNED_MAX = 127;
}
