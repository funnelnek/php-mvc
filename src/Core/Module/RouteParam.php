<?php

namespace Funnelnek\Core\Module;

class RouteParam
{
    protected string $namespace;
    protected array $conditions = [];

    public function __construct(
        protected string $key,
        protected string $match,
        protected string $name,
        protected int $offset
    ) {
        Router::registerParam($this);
    }

    public function setNamespace(string $namespace)
    {
        if (!isset($this->namespace)) {
            $this->namespace = $namespace;
        }
    }

    public function getNamespace()
    {
        return $this->namespace . "";
    }

    public function withCondition(string $condition, ?string $flag = "LOOKAHEAD")
    {
        $this->conditions[$flag][$condition] = $condition;
    }
}
