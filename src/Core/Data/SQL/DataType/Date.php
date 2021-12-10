<?php

namespace Funnelnek\Core\Data\SQL\DataType;


enum Date
{
    case DATE;
    case DATETIME;
    case TIMESTAMP;
    case TIME;
    case YEAR;
}
