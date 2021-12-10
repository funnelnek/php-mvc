<?php

declare(strict_types=1);

namespace Funnelnek\Configuration\Database;


use ReflectionClass;
use Funnelnek\Configuration\Database\DatabaseConfiguration;
use Funnelnek\Core\Application;
use Funnelnek\Core\Configuration;


class ApplicationDatabaseConfiguration extends DatabaseConfiguration
{
    // Private Instance Properties
    private array $databases = [];

    public function __construct(private Application $app)
    {
    }

    protected function boot(): void
    {
        $storages = glob(self::DATABASE_DIR . "/*", GLOB_NOSORT);
        foreach ($storages as $database) {
            $file = $this->getFile($database);
            $schema = self::DATABASE_NAMESPACE . "\\" . str_replace(".php", "", $file);

            require_once $database;

            if (class_exists($schema)) {
                $namespace = $schema;
                $schema = $this->databases[$namespace] = new ReflectionClass($schema);
                $context = $schema->getAttributes(DBContext::class);

                if (count($context)) {
                    $context = $context[0]->newInstance();
                    $config = $context->getConfiguration();
                }
            }
        }
    }
}
