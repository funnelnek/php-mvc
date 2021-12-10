<?php

namespace Funnelnek\Core\Data\SQL\DataType;

enum JSON
{
    case STRING;
    case NUMBER;
    case ARRAY;
    case OBJECT;
}
