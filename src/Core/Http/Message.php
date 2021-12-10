<?php

namespace Funnelnek\Core\Http;

use Funnelnek\Core\Application;
use Funnelnek\Core\Http\Interfaces\IMessage;

abstract class Message implements IMessage
{
    protected HttpProtocolVersion $protocolVersion = HttpProtocolVersion::VERSION_1_0;
    protected array $headers = [];

    public function __construct(protected Application $app)
    {
        $protocolVersion = strstr($this->app->server->protocol, '1');
        $this->protocolVersion = HttpProtocolVersion::fromString($protocolVersion);
    }


    public function getProtocolVersion(): string
    {
        return $this->protocolVersion->value;
    }

    public function withProtocolVersion(string $version = "1.0"): static
    {
        return $this;
    }

    abstract public function getHeaders(): array;
}
