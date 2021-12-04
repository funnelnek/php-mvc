<?php

namespace Funnelnek\Core\Http;

use Exception;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Attribute\Service\InjectionStrategy;
use Funnelnek\Core\Http\Interfaces\IRequest;
use Funnelnek\Core\Module\Application;

class Request implements IRequest
{
    public function __construct(Application $app)
    {
        $this->path = $app->pathinfo;
    }
    protected static bool $isInitialized = false;
    protected static array|null $queries;
    protected static array $headers;

    protected RequestHeader $header;
    protected HttpQuery $query;
    protected string $path = '/';
    protected string $url;
    protected string $method;
    protected string $id;
    protected array $body;

    protected array $cookies = [];

    protected static function create(Request $instance)
    {
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getBody()
    {
        return $this->body;
    }
    public function getHost(): string
    {
        return "";
    }
    public function getCookies()
    {
        return $this->cookies;
    }
}
