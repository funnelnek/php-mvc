<?php

namespace Funnelnek\Core\Router;

use Funnelnek\Core\Interfaces\IRouteParams;

class RouterParams implements IRouteParams
{
    protected array $params = [];

    public function __construct()
    {
    }

    /**
     * Method getParams
     *
     * @return array
     */
    public function getParams(): array|null
    {
        return $this->params;
    }

    public function hasParam(string $param)
    {
        return array_key_exists($param, $this->params);
    }

    public function count(): int
    {
        return count($this->params);
    }
}
