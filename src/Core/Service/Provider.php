<?php

namespace Funnelnek\Core\Service;

use Funnelnek\Core\Injection\Attributes\Dependency;
use Funnelnek\Core\Injection\Attributes\Injectiable;
use Funnelnek\Core\Service\Interfaces\IProvider;
use ReflectionClass;
use stdClass;

class Provider implements IProvider
{
    protected int $strategy = Injectiable::SCOPED;
    protected object $implementation;
    protected ReflectionClass $reflection;

    public function __construct(
        private string $id,
        private $container
    ) {
        $reflection = $this->reflection = new ReflectionClass($id);
        $injectiable = $reflection->getAttributes(Injectiable::class);

        if (count($injectiable)) {
            $provider = $injectiable[0]->newInstance();
            $this->strategy = $provider->strategy();
        }


        $this->resolve();
    }

    public function resolve()
    {
        $strategy = $this->strategy;
        $reflection = $this->reflection;
        $constructor = $reflection->getConstructor();
        $container = $this->container;

        if ($strategy == Injectiable::SINGLETON) {
            if (is_null($constructor)) {
                return $this->implementation = $reflection->newInstance();
            }

            $args = $constructor->getParameters();

            if (count($args)) {
                foreach ($args as $param) {
                    $name = $param->name;
                    $type = $param->getType();
                    $position = $param->getPosition();
                }
            }
        }
    }
}
