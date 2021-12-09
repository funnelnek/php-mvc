<?php

namespace Funnelnek\Core;



use Funnelnek\Core\Application;
use Funnelnek\Core\Application\Traits\ApplicationGetter;
use Funnelnek\Core\Configuration\Interfaces\IConfiguration;


abstract class Configuration implements IConfiguration
{


    /**
     * Method __construct
     *
     * @param private $app [explicite description]
     *
     * @return void
     */
    abstract public function __construct(Application $app);

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
    abstract public function load(): Configuration;
}
