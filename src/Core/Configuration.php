<?php

namespace Funnelnek\Core;



use Funnelnek\Core\Application;
use Funnelnek\Core\Configuration\Interfaces\IConfiguration;
use Funnelnek\Core\Traits\Accessor\ArrayAccessor;

abstract class Configuration implements IConfiguration
{
    use ArrayAccessor;

    /**
     * Method __construct
     *
     * @param private $app [explicite description]
     *
     * @return void
     */
    abstract public function __construct(Application $app, mixed ...$args);

    /**
     * @inheritDoc
     */
    public function get(string $key): mixed
    {
        return get_value($key, $this);
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        return get_value($key, $this) !== null;
    }

    /**
     * @inheritDoc
     */
    public function set(string $name, $value): bool
    {
        if (property_exists($this, $name)) {
            $this[$name] = $value;
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getOptions(): mixed
    {
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function load(): static
    {
        switch ($this->loaded) {
            case false:
                $this->boot();
            default:
                return $this;
        }
    }

    abstract protected function boot(): void;
}
