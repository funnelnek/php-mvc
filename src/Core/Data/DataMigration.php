<?php

namespace Funnelnek\Core\Data;

use ReflectionClass;

class DataMigration
{
    public function __construct(DatabaseContext $context)
    {
        $this->reflection = new ReflectionClass($context::class);
    }

    protected ReflectionClass $reflection;
    protected string $version;
    protected string $hash;
    protected string $file;
}
