<?php

namespace Funnelnek\Core\Interfaces;

interface IValidation
{
    public function isValid($data): bool;
}
