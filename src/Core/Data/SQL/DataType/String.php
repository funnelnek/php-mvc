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

    public function getMappingOfType(string $type)
    {
        $mapped = null;
        switch (strtolower($type)) {
            case "CHARACTER VARYING":
            case "CHARACTER":
                $mapped = StringType::VARCHAR;
                break;
        }
        return $mapped;
    }
}
