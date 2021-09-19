<?php

declare(strict_types=1);

namespace Funnelnek\Core\HTTP\Validation;

use Funnelnek\Configuration\Constant\Http\HttpMethodSupported;

use Funnelnek\Core\Interfaces\IValidation;
use ReflectionClass;

class HTTPMethodValidation implements IValidation
{
    public function isValid($method): bool
    {
        $reflection = new ReflectionClass(HttpMethodSupported::class);
        $constants = $reflection->getConstants();
        $method = strtoupper(trim($method));
        return $constants[$method];
    }
}
