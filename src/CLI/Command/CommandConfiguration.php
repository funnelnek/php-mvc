<?php

namespace Funnelnek\CLI\Command;

use Closure;
use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\Core\Traits\Accessor\ArrayAccessor;

use function Funnelnek\CLI\Utilities\cli;

class CommandConfiguration
{
    use ArrayAccessor;
    public readonly string               $id;
    public readonly Closure|array|string $controller;
    public readonly ActionDispatch       $type;
    public readonly string               $signature;
    public readonly string               $match;
    public readonly ?string              $shortcode;
    public readonly ?string              $description;

    public function __construct(
        string $id,
        string|Closure $controller,
        ActionDispatch $type,
        string $signature,
        ?string $shortcode = null,
        ?string $description = null
    ) {
        $this->id          = $id;
        $this->type        = $type;
        $this->shortcode   = $shortcode;
        $this->signature   = $signature;
        $this->controller  = $controller;
        $this->description = $description;
        $this->match       = cli($id, $signature, $shortcode);
        // convert signature into a regular expresson.
    }
}
