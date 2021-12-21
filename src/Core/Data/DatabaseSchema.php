<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Configuration\Database\DatabaseConfiguration;
use Funnelnek\Core\Application;
use ReflectionClass;
use ReflectionProperty;

class DatabaseSchema
{
    protected string $driver;
    protected DatabaseConfiguration $config;
    protected array $repositories = [];


    protected function getRepositories()
    {
    }

    protected function createTableSchema(ReflectionProperty $property)
    {
        $field = $property->name;
        $type = $property->getType();
        $name = "";

        if ($type->isBuiltin()) {
            $value = $property->getValue();
        }

        $info = $property->getAttributes(DBSet::class);
    }

    public function __construct(protected string $schema)
    {
        $app = Application::getInstance();

        if (!class_exists($schema)) {
            // @todo throw new Exception();
        }

        $context = new ReflectionClass($schema);
        $info = $context->getAttributes(DBContext::class);
        $info = array_shift($info);
        $tables = $context->getProperties();

        $this->driver = $info->driver;

        if (!$info) {
            // @todo throw new Exception();
        }

        $info = $info->newInstance();
        $config = $info->configuration;
        $configInfo = new ReflectionClass($config);

        $constructor = $configInfo->getConstructor();
        $services = $constructor->getParameters();
        $providers = [];

        foreach ($services as $service) {
            $type = $service->getType();

            if ($app instanceof $type) {
                $providers[] = $app;
            }

            $providers[] = $app->get($service);
        }

        $config = new $config($providers);

        if (method_exists($config, "load")) {
            $config->load();
        }

        if (method_exists($config, "boot")) {
            $config->boot();
        }

        foreach ($tables as $table) {
            $this->createTableSchema($table);
        }
    }


    public function build(): static
    {
        return $this;
    }
}
