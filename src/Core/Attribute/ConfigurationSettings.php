<?php

namespace Funnelnek\Core\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ConfigurationSettings
{
    public function __construct(
        protected ?string $name,
        protected ?array $options
    ) {
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOptions()
    {
        return $this->options;
    }
}
