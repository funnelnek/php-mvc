<?php

namespace Funnelnek\Core\Router;

use Funnelnek\Core\Interfaces\IRouteParams;

class RouterParams implements IRouteParams
{

    public function __construct(
        protected ?array $params = []
    ) {
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
