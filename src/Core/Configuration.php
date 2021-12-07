<?php

namespace Funnelnek\Core;



use Funnelnek\Core\Application;
use Funnelnek\Core\Application\Traits\ApplicationGetter;
use Funnelnek\Core\Attribute\ConfigurationSettings;
use Funnelnek\Core\Configuration\Interfaces\IConfiguration;
use ReflectionClass;


abstract class Configuration implements IConfiguration
{
    use ApplicationGetter;

    private static array $configurations = [];


    protected static function addConfiguration(string $key, Configuration $configurator)
    {
        self::$configurations[$key] = $configurator;
    }

    private ?Application $app;
    private ?ConfigurationSettings $settings;

    public readonly string $name;


    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        return get_value($key, $this);
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        return get_value($key, $this->options) !== null;
    }

    /**
     * @inheritDoc
     */
    public function load(): Configuration
    {
        $meta = new ReflectionClass(static::class);
        $settings = $meta->getAttributes(ConfigurationSettings::class);

        // Checks if Configuration Settings exists.
        if (count($settings)) {
            $settings = $this->settings = $settings[0]->newInstance();

            if (!isset($this->name)) {
            }
        }

        if (!isset(self::$configurations[static::class])) {
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function configure(string $name, $value): bool
    {
        $this[$name] = $value;
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getOptions()
    {
        return $this;
    }
}
