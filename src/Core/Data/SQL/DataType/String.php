<?php

namespace Funnelnek\Core\Data\SQL\DataType;


enum StringType
{
    case CHAR;
    case VARCHAR;
    case TEXT;
    case BINARY;
    case VARBINARY;
    case BLOB;
    case ENUM;
    case SET;
}
