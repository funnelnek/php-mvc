<?php

declare(strict_types=1);

namespace Funnelnek\Core\Router;

use Closure;
use Funnelnek\Core\Exception\Exception;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\Router\Exceptions\Constants\RouteError;
use Funnelnek\Core\Router\Exceptions\RouteParamException;


class RouteParam
{
    protected string $pattern;
    protected string $captured;
    protected Closure $resolver;
    protected string $match;

    public function __construct(
        protected string $name,
        protected array $options
    ) {
        $this->pattern = $options["pattern"];
        $this->captured = $options["captured"];
        $this->match = Route::convertParams($options["captured"]);
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getCaptured()
    {
        return $this->captured;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPattern(string $pattern)
    {
        $match = $this->pattern;
        $this->captured = str_replace($match, $pattern, $this->captured);
        $this->pattern = $pattern;
        $this->match = Route::convertParams($this->captured);
    }

    public function setResolver(Closure $resolver)
    {
        if (!is_callable($resolver)) {
            throw new RouteParamException(RouteError::INVALID_RESOLVER);
        }
        $this->resolver = $resolver;
    }

    public function resolve(Request $req, Closure $next)
    {
        $resolver = $this->resolver;
        try {
            if (isset($resolver) && is_callable($resolver)) {
                $resolver($req, $next);
            }
        } catch (Exception $exception) {
            $next($exception);
        }
    }
}
