<?php

namespace Funnelnek\Core\Data\SQL\DataType;

enum Numeric
{
    case BIT;
    case TINYINT;
    case BOOLEAN;
    case SMALLINT;
    case MEDIUMINT;
    case INT;
    case BIGINT;
    case DECIMAL;
    case FIXED;
    case FLOAT;
    case DOUBLE;

    public function getMappingOfType(string $type)
    {
        $mapped = null;
        switch (strtolower($type)) {
            case "FIXED":
            case "NUMERIC":
                $mapped = Numeric::DECIMAL;
                break;
            case "FLOAT4":
                $mapped = Numeric::FLOAT;
                break;
            case "FLOAT8":
                $mapped = Numeric::DOUBLE;
                break;
            case "INT1":
                $mapped = Numeric::TINYINT;
                break;
            case "INT2":
                $mapped = Numeric::SMALLINT;
                break;
            case "INT3":
                $mapped = Numeric::MEDIUMINT;
                break;
            case "INT4":
                $mapped = Numeric::INT;
                break;
            case "INT8":
                $mapped = Numeric::BIGINT;
                break;
        }
        return $mapped;
    }
}
